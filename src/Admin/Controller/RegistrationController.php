<?php

namespace App\Admin\Controller;

use App\Admin\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use FOS\UserBundle\Mailer\Mailer;
use FOS\UserBundle\Util\TokenGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\Authorization\AuthorizationChecker;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class RegistrationController extends Controller
{
    /**
     * @var Mailer $mailer
     */
    protected $mailer;

    /**
     * @var TokenGeneratorInterface $tokenGenerator
     */
    protected $tokenGenerator;

    /**
     * @var AuthorizationChecker $authChecker
     */
    protected $authChecker;

    /**
     * UserController constructor.
     * @param Mailer $mailer
     * @param TokenGeneratorInterface $tokenGenerator
     */
    public function __construct(Mailer $mailer, TokenGeneratorInterface $tokenGenerator)
    {
        $this->mailer = $mailer;
        $this->tokenGenerator = $tokenGenerator;
    }

    /**
     * @Route(path="/register", name="user_register", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param EncoderFactoryInterface $encoderFactory
     * @return JsonResponse
     * @throws Exception
     */
    public function registerAction(Request $request, EntityManagerInterface $entityManager, EncoderFactoryInterface $encoderFactory)
    {
        $fullName = $request->request->get('fullname');
        $email = $request->request->get('email');
        $address = $request->request->get('address');
        $country = $request->request->get('country');
        $city = $request->request->get('city');
        $town = $request->request->get('town');
        $phoneNumber = $request->request->get('phone');
        $companyName = $request->request->get('companyName');
        $passWord = $request->request->get('password');
        $rPassword = $request->request->get('rpassword');

        if ($passWord !== $rPassword) {
            return new JsonResponse([
                'status' => false,
                'message' => 'Şifreler farklı!'
            ]);
        }

        $userRepo = $entityManager->getRepository(User::class);
        $user = $userRepo->findOneBy(['email' => $email]);

        if ($user !== null) {
            return new JsonResponse([
                'status' => false,
                'message' => 'Kullanıcı mevcut!'
            ]);
        }

        $user = (new User())
            ->setUsernameCanonical($fullName)
            ->setUsername($email)
            ->setEmail($email)
            ->setAddress($address)
            ->setCompanyName($companyName)
            ->setPhoneNumber($phoneNumber)
            ->setCountry($country)
            ->setCity($city)
            ->setTown($town)
            ->setEnabled(1)
            ->setPlainPassword($passWord)
            ->addRole(User::ROLE_DEFAULT);

        $user->setConfirmationToken($this->tokenGenerator->generateToken());

        $encoder = $encoderFactory->getEncoder($user);

        if ($encoder instanceof BCryptPasswordEncoder) {
            $user->setSalt(null);
        } else {
            $salt = rtrim(str_replace('+', '.', base64_encode(random_bytes(32))), '=');
            $user->setSalt($salt);
        }

        $hashedPassword = $encoder->encodePassword($user->getPlainPassword(), $user->getSalt());
        $user->setPassword($hashedPassword);
        $user->eraseCredentials();

        $entityManager->persist($user);
        $entityManager->flush();

        $this->sendMail($user, 'create');

        return new JsonResponse([
            'status' => true,
            'message' => 'Kayıt olduğunuz için teşekkür ederiz. Aktivasyon mailiniz email adresinize gönderilmiştir.'
        ]);
    }

    /**
     * @Route(path="/user-change-password", name="user_change_password", methods={"POST"})
     */
    public function changePasswordAction()
    {

    }

    public function sendMail(User $user, string $type)
    {
        if ($type === 'create') {
            $this->mailer->sendConfirmationEmailMessage($user);
        } else {
            $this->mailer->sendResettingEmailMessage($user);
        }
    }
}

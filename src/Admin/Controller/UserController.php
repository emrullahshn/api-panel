<?php


namespace App\Admin\Controller;

use App\Admin\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserController extends Controller
{
    /**
     * @Route(path="/user-login", name="user_login", methods={"POST"})
     * @param Request $request
     */
    public function loginAction(Request $request){

    }

    /**
     * @Route(path="/register", name="user_register", methods={"POST"})
     * @param Request $request
     * @param EntityManagerInterface $entityManager
     * @param EncoderFactoryInterface $encoderFactory
     * @return JsonResponse
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
        $companyName = $request->request->get('company');
        $passWord = $request->request->get('password');
        $rPassword = $request->request->get('rpassword');

        if ($passWord !== $rPassword){
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
            ->setEmail($email)
            ->setAddress($address)
            ->setCompanyName($companyName)
            ->setPlainPassword()
            ->setEnabled(1)
            ->setRoles([User::ROLE_DEFAULT])
        ;
    }

    /**
     * @Route(path="/user-change-password", name="user_change_password", methods={"POST"})
     */
    public function changePasswordAction(){

    }
}

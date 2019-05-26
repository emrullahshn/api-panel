<?php

namespace App\Admin\Twig\Extensions;

use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;

class MenuItemAccordingToRoles extends \Twig_Extension
{

    /**
     * @var AuthorizationChecker $authorizationChecker
     */
    private $authorizationChecker;


    private $superAdminRoles = [];

    /**
     * MenuItemAccordingToRoles constructor.
     * @param AuthorizationCheckerInterface $authorizationChecker
     */
    public function __construct(AuthorizationCheckerInterface $authorizationChecker)
    {
        $this->authorizationChecker = $authorizationChecker;
    }

    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('checkRoleAccess', array($this, 'checkAccordingToRole')),
        );
    }

    public function checkAccordingToRole($roles)
    {
        return $this->authorizationChecker->isGranted($roles);

    }

    /**
     * {@inheritdoc}
     */
    public function getName(): string
    {
        return 'menu_item_according_to_roles';
    }
}

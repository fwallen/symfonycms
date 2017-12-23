<?php


namespace App\DataFixtures;


use App\Entity\Role;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Tests\Fixtures\ContainerAwareFixture;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminFixture extends ContainerAwareFixture
{
    protected $encoder;

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        foreach(['ROLE_USER', 'ROLE_ADMIN', 'ROLE_SUPER_ADMIN'] as $roleName) {
            $role = new Role();
            $role->setName($roleName);
            $manager->persist($role);
        }

        $manager->flush();

        $admin = new User();
        $admin->setUsername('admin')
            ->setEmail('admin@admin.dev')
            ->setFirstName('Admin')
            ->setLastName('Admin');
        $admin->setPassword($this->encoder->encodePassword($admin, 'admin'));

        $role = $manager->getRepository(Role::class)->findOneBy(['name' => 'ROLE_SUPER_ADMIN']);
        $admin->addRole($role);

        $manager->persist($admin);
        $manager->flush();

    }

}
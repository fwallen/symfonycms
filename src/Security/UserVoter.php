<?php


namespace App\Security;


use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class UserVoter extends Voter
{
    protected function supports( $attribute, $subject )
    {

        if ( ! $subject instanceof User){
            return false;
        }

        return true;
    }

    protected function voteOnAttribute( $attribute, $subject, TokenInterface $token )
    {
        return $attribute == 'ROLE';
    }

}
<?php

namespace App\Security\Voter;

use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class RestaurantVoter extends Voter
{
    protected function supports(string $attribute, $subject): bool
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['RESTAURANT_EDIT', 'RESTAURANT_DELETE'])
            && $subject instanceof \App\Entity\Restaurant;
    }

    protected function voteOnAttribute(string $action, $restaurant, TokenInterface $token): bool
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        // ... (check conditions and return true to grant permission) ...
        switch ($action) {
            case 'RESTAURANT_EDIT':
            case 'RESTAURANT_DELETE':
                return $restaurant->getCoworker() === $user;
                break;
        }

        return false;
    }
}

<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\UtilisateurRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Service\CrudService as CrudService;
use Doctrine\ORM\EntityManagerInterface;
class UtilisateurController extends AbstractController {

    private $__crudService ;
    public function __construct(EntityManagerInterface $em , SerializerInterface $serialize){

        $this -> __crudService = new CrudService($em, Utilisateur::class, $serialize);

    }
    /**
     * @Route("/api/utilisateurs", name="get_utilisateurs")
     */
    public function getAllUtilisateurs(SerializerInterface $serializer): Response
    {
        return $this -> __crudService -> setModel(Utilisateur::class) -> response(Response::HTTP_OK );

    }
        /**
     * @Route("/api/utilisateur", name="get_utilisateur_by_id")
     */
    public function getUtilisateur(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        return $this -> __crudService -> setModel(Utilisateur::class) -> response(Response::HTTP_OK,$data["id"] );

    }
            /**
     * @Route("/api/getcurrent", name="get_current_user", methods="GET")
     */
    public function getCurrentUser(Security $security): Response
    {
        $user = $this->get("security.token_storage")->getToken()->getUser();
           return $this->__crudService -> setModel(Utilisateur::class) -> response( Response::HTTP_OK,$user);


    }

    /**
     * @Route("/register", name="add_utilisateur" , methods="POST")
     */
    public function register(Request $request,  UserPasswordEncoderInterface $encoder,UtilisateurRepository $repo): Response
    {
        $data = json_decode($request->getContent(), true);
        $nom=$data["nom"];
        $prenom=$data["prenom"];
        $telephone=$data["telephone"];
        $type=$data["type"];
        $password=$data["password"];
        $username=$data["username"];

        $utilisateur= new Utilisateur();
        $utilisateur->setPassword($encoder->encodePassword($utilisateur, $password));
        $utilisateur->setUsername($username);
        $utilisateur->setNom($nom);
        $utilisateur->setPrenom($prenom);
        $utilisateur->setTelephone($telephone);
        $utilisateur->setType($type);

        return $this->__crudService-> setModel(Utilisateur::class) -> add($utilisateur) -> response(Response::HTTP_OK,$utilisateur);


    }
    /**
 * @Route("/login_check", name="login", methods={"POST"})
 */
public function login()
{
$user= $this->getUser();
return $this->json($user);
}
/*     public function register(Request $request, UserPasswordEncoderInterface $encoder, SerializerInterface $serializer)
    {
        $data = json_decode($request->getContent(), true);
        $password=$data["password"];
        $username=$data["username"];
        $tel=$data["tel"];

        $utilisateur=new Utilisateur();

        $utilisateur->setPassword($encoder->encodePassword($utilisateur, $password));


    } */

}

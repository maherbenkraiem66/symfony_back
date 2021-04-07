<?php


namespace App\Controller;



use App\Entity\Reclamation;
use App\Entity\Region;
use App\Entity\Utilisateur;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\CrudService as CrudService;
use Doctrine\ORM\EntityManagerInterface;

class ReclamationController extends AbstractController
{

    private $__crudService ;
    public function __construct(EntityManagerInterface $em , SerializerInterface $serialize){

        $this -> __crudService = new CrudService($em, Reclamation::class, $serialize);

    }

    /**
     * @Route("/api/getReclamations", name="getReclamation")
     */
    public function getAllReclamations(): Response
    {
        return $this -> __crudService -> setModel(Reclamation::class)
            -> response(Response::HTTP_OK );

    }


//Ajouter une Reclamation
    /**
     * @Route("/api/Ajout", name="add_Rec" , methods="POST")
     * @param Request $request
     * @param ReclamationRepository $repo
     * @return Response
     */
    public function AjoutReclamation(Request $request,  ReclamationRepository $repo): Response
    {
        $crud = $this->__crudService-> setModel(Reclamation::class) ;
        $data = json_decode($request->getContent(), true);


        $titre=$data["titre"];
        $description=$data["description"];
        //userid
        $utilisateur_id=$data["utilisateur_id"];
        $crud->setModel(Utilisateur::class);

        $reclamtion= new Reclamation();
        $reclamtion->setTitre($titre);
        $reclamtion->setDescription($description);
        $crud->setModel(Utilisateur::class);

        $reclamtion->setUtilisateur($crud->get($utilisateur_id));

        $this->__crudService-> setModel(Reclamation::class) -> add($reclamtion)  ;
        $reclamtion->setUtilisateur(null);
        return $this->__crudService
         -> response(Response::HTTP_OK,$reclamtion);


    }


    //GetById
    /**
     * @Route("/api/ReclamationByID", name="get_Reclamtion_by_id")
     */
    public function getAllReclamtions(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        return $this -> __crudService -> setModel(Reclamation::class) -> response(Response::HTTP_OK,$data["id"] );

    }






}

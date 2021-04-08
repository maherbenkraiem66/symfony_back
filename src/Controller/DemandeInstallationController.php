<?php

namespace App\Controller;

use App\Entity\DemandeInstallation;
use App\Entity\Region;
use App\Entity\Utilisateur;
use App\Repository\DemandeInstallationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Security\Core\Security;
use App\Service\CrudService as CrudService;
use Doctrine\ORM\EntityManagerInterface;

class DemandeInstallationController extends AbstractController
{

    private $__crudService ;
    public function __construct(EntityManagerInterface $em , SerializerInterface $serialize){

        $this -> __crudService = new CrudService($em, DemandeInstallation::class, $serialize);

    }


    /**
     * @Route("/api/getAlldemandeInstallation" ,name="get_demande")
     */
    public function getAllDemandes(SerializerInterface $serializer): Response
    {
        return $this -> __crudService -> setModel(DemandeInstallation::class) -> response(Response::HTTP_OK );

    }


    /**
     * @Route("/api/getdemandeInstallationByID", name="get_demande_by_id")
     * @param Request $request
     * @return Response
     */
    public function getAllDemandebyId(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        return $this -> __crudService -> setModel(DemandeInstallation::class) -> response(Response::HTTP_OK,$data["id"] );

    }

    /**
     * @Route("/api/ajoutDamande", name="add_demande" , methods="POST")
     * @param Request $request
     * @param DemandeInstallationRepository $repo
     * @return Response
     */
    public function AjoutDemande(Request $request,  DemandeInstallationRepository $repo): Response
    {
        $crud = $this->__crudService-> setModel(DemandeInstallation::class) ;
        $data = json_decode($request->getContent(), true);
        $longitude=$data["longitude"];
        $latitude=$data["latitude"];
        $date=new \DateTime($data["date"]);

        //userid
        $utilisateur_id=$data["utilisateur_id"];
        $crud->setModel(Utilisateur::class);

        //RegionId
        $region=$data["region_id"];
        $crud->setModel(Region::class);

        $Demande= new DemandeInstallation();
        $Demande->setLongitude($longitude);
        $Demande->setLatitude($latitude);
        $Demande->setDate($date);

        $crud->setModel(Utilisateur::class);
        $Demande->setUtilisateur($crud->get($utilisateur_id));

        $crud->setModel(Region::class);
        $Demande->setRegion($crud->get($region));



        return $this->__crudService-> setModel(DemandeInstallation::class) -> add($Demande) -> response(Response::HTTP_OK,$Demande);


    }


    //Without Update

    /**
     * @Route("/api/dmandeUpdate", name="add_demande" , methods="POST")
     */
    public function UpdateDemande(Request $request,  DemandeInstallationRepository $repo): Response
    {

        $data = json_decode($request->getContent(), true);
        $crud=$this->__crudService;
        $Demande= $crud -> setModel(DemandeInstallation::class) ->get($data["id"]);


        $longitude=$data["longitude"];
        $latitude=$data["latitude"];
        $date=new \DateTime($data["date"]);

        //userid
        $utilisateur_id=$data["utilisateur_id"];
        $crud->setModel(Utilisateur::class);

        //RegionId
        $region=$data["region_id"];
        $crud->setModel(Region::class);

        $Demande= new DemandeInstallation();
        $Demande->setLongitude($longitude);
        $Demande->setLatitude($latitude);
        $Demande->setDate($date);
        $crud->setModel(Utilisateur::class);

        $Demande->setUtilisateur($crud->get($utilisateur_id));
        $crud->setModel(Region::class);

        $Demande->setRegion($crud->get($region));



        return $this->__crudService-> setModel(DemandeInstallation::class) -> add($Demande) -> response(Response::HTTP_OK,$Demande);


    }




}

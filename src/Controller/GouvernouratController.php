<?php


namespace App\Controller;
use App\Entity\Gouvernorat;
use App\Entity\Region;
use App\Repository\GouvernoratRepository;
use App\Repository\PTSRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\CrudService as CrudService;
use Doctrine\ORM\EntityManagerInterface;


class GouvernouratController extends AbstractController
{

    private $__crudService ;
    public function __construct(EntityManagerInterface $em , SerializerInterface $serialize){

        $this -> __crudService = new CrudService($em, Gouvernorat::class, $serialize);

    }

    /**
     * @Route("/api/getAllGouvernorat", name="getGouvernorat")
     */
    public function getAllGouvernorats(SerializerInterface $serializer): Response
    {
        return $this -> __crudService -> setModel(Gouvernorat::class) -> response(Response::HTTP_OK );

    }

    /**
     * @Route("/api/addGouvernorat", name="add_Gouvernorat" , methods="POST")
     * @param Request $request
     * @param PTSRepository $repo
     * @return Response
     */
    public function AjouterGouvernorat(Request $request, GouvernoratRepository $repo): Response
    {
        $crud = $this->__crudService-> setModel(Gouvernorat::class) ;
        $data = json_decode($request->getContent(), true);

        $name=$data["name"];

        //idRegion
        //RegionId
        $region=$data["region_id"];
        $crud->setModel(Region::class);



        $gouv= new Gouvernorat();
        $gouv->setName($name);


        $crud->setModel(Region::class);
        $gouv->setRegion($crud->get($region));

        return $this->__crudService-> setModel(Gouvernorat::class) -> add($gouv) -> response(Response::HTTP_OK,$gouv);


    }


    //GetById
    /**
     * @Route("/api/gouvernoratByID", name="get_Gouvernorat_by_id")
     * @param Request $request
     * @return Response
     */
    public function getPTSById(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        return $this -> __crudService -> setModel(Gouvernorat::class) -> response(Response::HTTP_OK,$data["id"] );

    }


    //Update



}

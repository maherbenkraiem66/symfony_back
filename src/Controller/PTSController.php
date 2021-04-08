<?php


namespace App\Controller;
use App\Entity\PTS;
use App\Entity\Region;
use App\Repository\PTSRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\CrudService as CrudService;
use Doctrine\ORM\EntityManagerInterface;

class PTSController extends AbstractController
{

    private $__crudService ;
    public function __construct(EntityManagerInterface $em , SerializerInterface $serialize){

        $this -> __crudService = new CrudService($em, PTS::class, $serialize);

    }

    /**
     * @Route("/api/getAllPTS", name="getPTS")
     */
    public function getAllPTSs(SerializerInterface $serializer): Response
    {
        return $this -> __crudService -> setModel(PTS::class) -> response(Response::HTTP_OK );

    }

    /**
     * @Route("/api/addPTS", name="add_PTS" , methods="POST")
     * @param Request $request
     * @param PTSRepository $repo
     * @return Response
     */
    public function AjouterPTS(Request $request, PTSRepository $repo): Response
    {
        $crud = $this->__crudService-> setModel(PTS::class) ;
        $data = json_decode($request->getContent(), true);

        $logitude=$data["logitude"];
        $latitude=$data["latitude"];
        $altitude=$data["altitude"];

        //idRegion
        //RegionId
        $region=$data["region_id"];
        $crud->setModel(Region::class);



        $pts= new PTS();
        $pts->setLogitude($logitude);
        $pts->setLatitude($latitude);
        $pts->setAltitude($altitude);


        $crud->setModel(Region::class);
        $pts->setRegion($crud->get($region));

        return $this->__crudService-> setModel(PTS::class) -> add($pts) -> response(Response::HTTP_OK,$pts);


    }


    //GetById
    /**
     * @Route("/api/PTSByID", name="get_PTS_by_id")
     * @param Request $request
     * @return Response
     */
    public function getPTSById(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        return $this -> __crudService -> setModel(PTS::class) -> response(Response::HTTP_OK,$data["id"] );

    }


    //Update


}

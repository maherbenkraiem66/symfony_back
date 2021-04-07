<?php


namespace App\Controller;



use App\Entity\DemandeInstallation;
use App\Entity\Region;
use App\Repository\RegionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Service\CrudService as CrudService;
use Doctrine\ORM\EntityManagerInterface;

class RegionController extends AbstractController
{

    private $__crudService ;
    public function __construct(EntityManagerInterface $em , SerializerInterface $serialize){

        $this -> __crudService = new CrudService($em, Region::class, $serialize);

    }

    /**
     * @Route("/api/Region", name="getRegion")
     * @param SerializerInterface $serializer
     * @return Response
     */
    public function getAllRegions(SerializerInterface $serializer): Response
    {
        return $this -> __crudService -> setModel(Region::class) -> response(Response::HTTP_OK );

    }

    /**
     * @Route("/api/AddRegion", name="add_Region" , methods="POST")
     * @param Request $request
     * @param RegionRepository $repo
     * @return Response
     */
    public function AjouterRegion(Request $request, RegionRepository $repo): Response
    {
        $data = json_decode($request->getContent(), true);
        $name=$data["name"];

        $region= new Region();
        $region->setName($name);

        return $this->__crudService-> setModel(Region::class) -> add($region) -> response(Response::HTTP_OK,$region);


    }


    //GetById
    /**
     * @Route("/api/RegionByID", name="get_Region_by_id")
     * @param Request $request
     * @return Response
     */
    public function getAllRegion(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        return $this -> __crudService -> setModel(Region::class) -> response(Response::HTTP_OK,$data["id"] );

    }


    //Update

}

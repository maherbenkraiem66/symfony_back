<?php
namespace App\Service;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\EntityManagerInterface;

class CrudService extends AbstractService
{

  public function __construct(EntityManagerInterface $em, $entityName, $serializerInterface)
  {
    $this -> em = $em;
    //$this -> model = $em -> getRepository($entityName);
    $this -> serializer = $serializerInterface;
  }


  public function setModel(string $entityName) : CrudService {
     $this -> model =  $this -> em -> getRepository($entityName);
     return $this ;
  }

  public function getModel()
  {
    return $this->model ;
  }

  public function deleteObject($id)
  {
    return $this->delete($this->find($id));
  }

  public function get($id)
  {
    return $this -> find($id) ;
  }
  public function getAll()
  {
    return $this -> findAll();
  }



  public function add($object)
  {
     $this->save($object);
     return $this ;
  }
  public function response($response_code,$criteria = null )
  {

    $response  = new Response($this -> json($criteria) , $response_code, [], true);
    $response -> headers->set('Content-Type', 'application/json');
    //$response -> headers->set('Access-Control-Allow-Origin', 'http://localhost:3000');

    return $response;

  }

  public function json($criteria)
  {
    if($criteria === null){
      return $this->serializer->serialize($this -> getAll(), 'json', ['groups' => ['default']]);
    }
    else if (is_object($criteria))
    {
      return $this->serializer->serialize(($criteria), 'json', ['groups' => ['default']]);
    }
    else if(is_int($criteria)){
      return $this->serializer->serialize($this -> get($criteria), 'json', ['groups' => ['default']]);
    }

    else{
      return $this->serializer->serialize($this -> findBy($criteria), 'json', ['groups' => ['default']]);
    }

    }
}

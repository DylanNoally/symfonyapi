<?php
namespace App\Controller;
use App\Entity\Roles;
use App\Form\RolesType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

class RoleController extends AbstractController
{
    /**
     * @Route("roles/new", methods={"GET","POST"}, name="newRole")
     */
    public function new(Request $request)
    {
                $role = new Roles();
                $display = $this->getDoctrine()->getManager();
                $form = $this->createForm(RolesType::class, $role);
                $repository = $display->getRepository(Roles::class);
                //$listRoles = $repository->findAll();

                // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
                    $role = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();
                // Persist prépare l'entité "User" pour la création //
                $entityManager->persist($role);
                // Flush envoie les infos en base (ajout) //
                $entityManager->flush();
                $this->addFlash('success', 'Votre rôle à bien été enregistré.');

                return $this->redirect($this->generateUrl('listRoles'));


                }
                return $this->render('role/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("roles/list", name="listRoles", methods={"GET","POST"})
     */
    public function list(Request $httpRequest)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des roles
        $repository = $display->getRepository(Roles::class);
        $listRoles = $repository->findAll();

       // --------------------------
        // on demande à la vue d'afficher la liste des roles
        // --------------------------
        return $this->render('role/list.html.twig', array('lesRoles' => $listRoles));        
    }    

    /**
     * @Route("roles/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editRole")
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $repository = $this->getDoctrine()->getManager()->getRepository(Roles::class);
        $editRole = $repository->find($id);

        $display = $this->getDoctrine()->getManager();

        $repository = $display->getRepository(Roles::class);
        $listRoles = $repository->findAll();

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(RolesType::class, $editRole);
        $form->add('statut', CheckboxType::class, array(
                    'label'    => 'Statut Actif',
                    'required' => false));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
            $editRole = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirect($this->generateUrl('listRoles'));
            }
                return $this->render('role/edit.html.twig', array('form' => $form->createView(), 'lesRoles' => $listRoles, 'editRole' => $editRole ));
    }

    /**
     * @Route("/delete/{id}", name="deleteRole", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
       // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        $RolesRepository = $display->getRepository(Roles::class); 
        
        $deleteRole = $RolesRepository->find($id);

        $display->remove($deleteRole);

        $display->flush(); 

        return $this->redirectToRoute('listRoles');              
    }    
}

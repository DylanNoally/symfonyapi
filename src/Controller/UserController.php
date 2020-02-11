<?php
namespace App\Controller;
use App\Entity\User;
use App\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class UserController extends AbstractController
{
    /**
     * @Route("users/new", methods={"GET","POST"}, name="newUser")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
                $user = new User();
                $display = $this->getDoctrine()->getManager();
                $form = $this->createForm(UserType::class, $user);
                $repository = $display->getRepository(User::class);
                //$listUser = $repository->findAll();

                // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
                    $user = $form->getData();

/*                    $userFirstName = $form['userFirstName']->getData();*/
                $password = $passwordEncoder->encodePassword($user, $user->getPassword());
                $user->setPassword($password);

                $userPhoto = $form['photo']->getData();
                $userEmail = $form['email']->getData();

                $file = $userPhoto;    

                if ($file !== null)
                {
                    $fileName = $file->getClientOriginalName();

                    // On envoit le fichier dans le dossier images
                    try {
                        $file->move($this->getParameter('images_directory'), $fileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $user->setPhoto($fileName);
                }

                $entityManager = $this->getDoctrine()->getManager();
                // Persist prépare l'entité "User" pour la création //
                $entityManager->persist($user);
                // Flush envoie les infos en base (ajout) //
                $entityManager->flush();
                $this->addFlash('success', 'Votre compte à bien été enregistré.');

                return $this->redirect($this->generateUrl('listUsers'));


                }
                return $this->render('security/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("users/list", name="listUsers", methods={"GET","POST"})
     */
    public function list(Request $httpRequest)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des users
        $repository = $display->getRepository(User::class);
        $listUser = $repository->findAll();

       // --------------------------
        // on demande à la vue d'afficher la liste des users
        // --------------------------
        return $this->render('security/list.html.twig', array('lesUsers' => $listUser));        
    }    

    /**
     * @Route("users/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editUsers")
     */
    public function edit($id, Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        // Appel de Doctrine
        $repository = $this->getDoctrine()->getManager()->getRepository(User::class);
        $editUser = $repository->find($id);

        $display = $this->getDoctrine()->getManager();

        $repository = $display->getRepository(User::class);
        $listUsers = $repository->findAll();

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(UserType::class, $editUser);
        $form->add('statut', CheckboxType::class, array(
                    'label'    => 'Statut Actif',
                    'required' => false));

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
            $editUser = $form->getData();
            $userPhoto = $form['photo']->getData();            
            $userEmail = $form['email']->getData();
            $userPassword = $form['password']->getData();

            $file = $userPhoto;

            $entityManager = $this->getDoctrine()->getManager();

            if ($file !== null)
            {
                // On vérifie si le fichier est en base
                if($editUser->getPhoto() !== null)
                {
                    // Variable qui contient l'ancien fichier
                    $oldFile = $this->getParameter('images_directory').'/'.
                        $editUser->getPhoto();

                    // On supprime l'ancien fichier en local
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $fileName = $file->getClientOriginalName();

                // On envoit le fichier dans le dossier images
                try {
                    $file->move($this->getParameter('images_directory'), $fileName);
                } catch (FileException $e) {
                    // S'il y a un soucis pendant l'upload on catch
                }

                $editUser->setPhoto($fileName); 
            }               

            if ($userPassword !== null) 
            {
                $password = $passwordEncoder->encodePassword($editUser, $editUser->getPassword());
                $editUser->setPassword($password);
            }


            $entityManager->flush();

            return $this->redirect($this->generateUrl('listUsers'));
            }
                return $this->render('security/edit.html.twig', array('form' => $form->createView(), 'lesUsers' => $listUsers, 'editUser' => $editUser ));
    }

    /**
     * @Route("/delete/{id}", name="deleteUser", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
       // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        $UserRepository = $display->getRepository(User::class); 
        
        $deleteUser = $UserRepository->find($id);

        $display->remove($deleteUser);

        $display->flush(); 

        return $this->redirectToRoute('listUsers');              
    }    
}

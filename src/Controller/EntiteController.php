<?php
namespace App\Controller;
use App\Entity\Entite;
use App\Form\EntiteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

// Préfix url
/**
 * @Route("/entite")
 */
class EntiteController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newEntite")
     */
    public function new(Request $request)
    {
                $entite = new Entite();
                $display = $this->getDoctrine()->getManager();
                $form = $this->createForm(EntiteType::class, $entite);
                $repository = $display->getRepository(Entite::class);
                //$listEntites = $repository->findAll();

                // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
                    $entite = $form->getData();

                $entitePhoto = $form['photo']->getData();
                $entitePhotoAdd = $form['photo_additionnelle']->getData();
                $entiteLogo = $form['logo']->getData();
                $entitePdf = $form['fichier_pdf']->getData();

                $file = $entitePhoto;  
                $fileAdd = $entitePhotoAdd;  
                $fileLogo = $entiteLogo;
                $filePdf = $entitePdf; 

                if ($file !== null)
                {
                    $fileName = $file->getClientOriginalName();

                    // On envoit le fichier dans le dossier images
                    try {
                        $file->move($this->getParameter('images_directory'), $fileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $entite->setPhoto($fileName);
                }

                if($fileAdd !== null)
                {
                    $fileName = $fileAdd->getClientOriginalName();

                    // On envoit le fichier dans le dossier images
                    try {
                        $fileAdd->move($this->getParameter('images_directory'), $fileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $entite->setPhotoAdditionnelle($fileName);
                }

                if($fileLogo !== null)
                {
                    $fileName = $fileLogo->getClientOriginalName();

                    // On envoit le fichier dans le dossier images
                    try {
                        $fileLogo->move($this->getParameter('images_directory'), $fileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $entite->setLogo($fileName);
                }

                if($filePdf !== null){
                     $fileName = $filePdf->getClientOriginalName();

                    // On envoit le fichier dans le dossier images
                    try {
                        $filePdf->move($this->getParameter('pdf_directory'), $fileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $entite->setFichierPdf($fileName);
                }                   

                $entityManager = $this->getDoctrine()->getManager();
                // Persist prépare l'entité "entite" pour la création //
                $entityManager->persist($entite);
                // Flush envoie les infos en base (ajout) //
                $entityManager->flush();
                $this->addFlash('success', 'Votre compte à bien été enregistré.');

                return $this->redirect($this->generateUrl('listEntites'));


                }
                return $this->render('entite/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/list", name="listEntites", methods={"GET","POST"})
     */
    public function list(Request $httpRequest)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des Entites
        $repository = $display->getRepository(Entite::class);
        $listEntite = $repository->findAll();

       // --------------------------
        // on demande à la vue d'afficher la liste des Entites
        // --------------------------
        return $this->render('entite/list.html.twig', array('lesEntites' => $listEntite));        
    }    

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editEntite")
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $repository = $this->getDoctrine()->getManager()->getRepository(Entite::class);
        $editEntite = $repository->find($id);

        $display = $this->getDoctrine()->getManager();

        $repository = $display->getRepository(Entite::class);
        $listEntites = $repository->findAll();

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(EntiteType::class, $editEntite);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
            $entitePhoto = $form['photo']->getData();
            $entitePhotoAdd = $form['photo_additionnelle']->getData();
            $entiteLogo = $form['logo']->getData();
            $entitePdf = $form['fichier_pdf']->getData();

            $file = $entitePhoto;  
            $fileAdd = $entitePhotoAdd;  
            $fileLogo = $entiteLogo; 
            $filePdf = $entitePdf;

            $entityManager = $this->getDoctrine()->getManager();

            if($file !== null)
            {
                // On vérifie si le fichier est en base
                if($editEntite->getPhoto() !== null)
                {
                    // Variable qui contient l'ancien fichier
                    $oldFile = $this->getParameter('images_directory').'/'.
                        $editEntite->getPhoto();

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

                $editEntite->setPhoto($fileName); 
            }  

            if($fileAdd !== null)
            {
                // On vérifie si le fichier est en base
                if($editEntite->getPhotoAdditionnelle() !== null)
                {
                    // Variable qui contient l'ancien fichier
                    $oldFile = $this->getParameter('images_directory').'/'.
                        $editEntite->getPhotoAdditionnelle();

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

                $editEntite->setPhotoAdditionnelle($fileName); 
            }

            if($fileLogo !== null)
            {
                // On vérifie si le fichier est en base
                if($editEntite->getLogo() !== null)
                {
                    // Variable qui contient l'ancien fichier
                    $oldFile = $this->getParameter('images_directory').'/'.
                        $editEntite->getLogo();

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

                $editEntite->setLogo($fileName); 
            }

            if($filePdf !== null)
            {
                // On vérifie si le fichier est en base
                if($editEntite->getFichierPdf() !== null)
                {
                    // Variable qui contient l'ancien fichier
                    $oldFile = $this->getParameter('pdf_directory').'/'.
                    $editEntite->getFichierPdf();

                    // On supprime l'ancien fichier en local
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                }

                $fileName = $file->getClientOriginalName();

                // On envoit le fichier dans le dossier pdf
                try {
                    $file->move($this->getParameter('pdf_directory'), $fileName);
                } catch (FileException $e) {
                    // S'il y a un soucis pendant l'upload on catch
                }

                $editEntite->setFichierPdf($fileName);                 
            }                                        


            $entityManager->flush();

            return $this->redirect($this->generateUrl('listEntites'));
            }
                return $this->render('entite/edit.html.twig', array('form' => $form->createView(), 'lesEntites' => $listEntites, 'editEntite' => $editEntite ));
    }

    /**
     * @Route("/delete/{id}", name="deleteEntite", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
       // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        $EntiteRepository = $display->getRepository(Entite::class); 
        
        $deleteEntite = $EntiteRepository->find($id);

        $display->remove($deleteEntite);

        $display->flush(); 

        return $this->redirectToRoute('listEntites');              
    }    
}

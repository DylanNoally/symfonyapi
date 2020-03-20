<?php
namespace App\Controller;
use App\Entity\Diaporama;
use App\Form\DiaporamaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;

// Préfix url
/**
 * @Route("/diaporama")
 */
class DiaporamaController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newDiaporama")
     */
    public function new(Request $request)
    {
                $diaporama = new Diaporama();
                $display = $this->getDoctrine()->getManager();
                $form = $this->createForm(DiaporamaType::class, $diaporama);
                $repository = $display->getRepository(Diaporama::class);
                //$listDiaporamas = $repository->findAll();

                // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
                    $diaporama = $form->getData();

                $diapoImage = $form['image']->getData();

                $file = $diapoImage;    

                if ($file !== null)
                {
                    $fileName = $file->getClientOriginalName();

                    // On envoit le fichier dans le dossier images
                    try {
                        $file->move($this->getParameter('images_directory'), $fileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $diaporama->setImage($fileName);
                }                                    

                $entityManager = $this->getDoctrine()->getManager();
                // Persist prépare l'entité "User" pour la création //
                $entityManager->persist($diaporama);
                // Flush envoie les infos en base (ajout) //
                $entityManager->flush();
                $this->addFlash('success', 'Votre diaporama à bien été enregistré.');

                return $this->redirect($this->generateUrl('listDiaporamas'));


                }
                return $this->render('diaporama/new.html.twig', array('form' => $form->createView()));
    }

    /**
     * @Route("/list", name="listDiaporamas", methods={"GET","POST"})
     */
    public function list(Request $httpRequest)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des Diaporamas
        $repository = $display->getRepository(Diaporama::class);
        $listDiaporamas = $repository->findAll();

       // --------------------------
        // on demande à la vue d'afficher la liste des Diaporamas
        // --------------------------
        return $this->render('diaporama/list.html.twig', array('lesDiaporamas' => $listDiaporamas));        
    }    

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editDiaporama")
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $repository = $this->getDoctrine()->getManager()->getRepository(Diaporama::class);
        $editDiaporama = $repository->find($id);

        $display = $this->getDoctrine()->getManager();

        $repository = $display->getRepository(Diaporama::class);
        $listDiaporamas = $repository->findAll();

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(DiaporamaType::class, $editDiaporama);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
            $editDiaporama = $form->getData();

            $diapoImage = $form['image']->getData();

            $file = $diapoImage;             

            $entityManager = $this->getDoctrine()->getManager();

            if ($file !== null)
            {
                // On vérifie si le fichier est en base
                if($editDiaporama->getImage() !== null)
                {
                    // Variable qui contient l'ancien fichier
                    $oldFile = $this->getParameter('images_directory').'/'.
                        $editDiaporama->getImage();

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

                $editDiaporama->setImage($fileName); 
            }            

            $entityManager->flush();

            return $this->redirect($this->generateUrl('listDiaporamas'));
            }
                return $this->render('diaporama/edit.html.twig', array('form' => $form->createView(), 'lesDiaporamas' => $listDiaporamas, 'editDiaporama' => $editDiaporama ));
    }

    /**
     * @Route("/delete/{id}", name="deleteDiaporama", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
       // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        $DiaporamaRepository = $display->getRepository(Diaporama::class); 
        
        $deleteDiaporama = $DiaporamaRepository->find($id);

        $display->remove($deleteDiaporama);

        $display->flush(); 

        return $this->redirectToRoute('listDiaporamas');              
    }    
}

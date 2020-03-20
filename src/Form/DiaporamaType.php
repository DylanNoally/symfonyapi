<?php
namespace App\Form;

use App\Entity\Diaporama;
use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class DiaporamaType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('titre', TextType::class, ['label' => 'Titre', 'required' => true])
            ->add('resume', TextareaType::class, ['label' => 'Résumé', 'required' => false])
            ->add('id_categorie', EntityType::class, array('class' => Categorie::class, 'choice_label' => 'libelle', 'label'=>'Catégorie', 'placeholder'=>'', 'required' => true))            
    		->add('date_debut_affichage', DateType::class,  array('label' => "Date de début d'affichage", 'widget' => 'single_text', 'required' => true)) 
            ->add('date_fin_affichage', DateType::class,  array('label' => "Date de fin d'affichage", 'widget' => 'single_text', 'required' => false))             
    		->add('libelle_bouton', TextType::class, array('label' => 'Libellé du bouton', 'required' => false))
    		->add('url_bouton', TextType::class, array('label' => 'Url du bouton', 'required' => false))
            ->add('case_nouvel_onglet', CheckboxType::class, array('label'    => 'Nouvel onglet', 'required' => false))
            ->add('image', FileType::class, ['label' => 'Image', 'required' => false,
                'data_class' => null])                 					

            // Bouton Submit //
            ->add('save', SubmitType::class, array('label' => 'ENREGISTRER'))->getForm();
	}
}
?>

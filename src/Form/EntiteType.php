<?php
namespace App\Form;

use App\Entity\Entite;
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
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EntiteType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('titre', TextType::class, ['label' => 'Titre', 'required' => true])
            ->add('resume', TextareaType::class, ['label' => 'Résumé', 'required' => false])
    		->add('texte_long', TextareaType::class, array('label' => 'Texte long', 'required' => false))
            ->add('date_de_publication', DateType::class,  array('label' => 'Date de publication', 'widget' => 'single_text', 'required' => false))             
    		->add('photo', FileType::class, array('label' => 'Photo', 'required' => false,
                'data_class' => null))
    		->add('photo_additionnelle', FileType::class,  array('label' => 'Photo additionnelle','required' => false,
                'data_class' => null)) 
			->add('etat', CheckboxType::class, array(
                    'label'    => 'Publié',
                    'required' => false))
    		->add('fichier_pdf', FileType::class, array('label' => 'Fichier PDF', 'required' => false, 'data_class' => null))
    		->add('liens', TextType::class, array('label' => 'Lien utile', 'required' => false))
    		->add('logo', FileType::class,  array('label' => 'Logo', 'required' => false,
                'data_class' => null))
            ->add('adresse', TextType::class,  array('label' => 'Adresse', 'required' => false))   		
            ->add('complement_adresse', TextType::class,  array('label' => "Complément d'adresse", 'required' => false))
            ->add('code_postal', TextType::class,  array('label' => 'Logo', 'required' => false))		
            ->add('ville', TextType::class,  array('label' => 'Ville', 'required' => false))
            ->add('telephone', TelType::class,  array('label' => 'Téléphone', 'required' => false))
            ->add('fax', TelType::class,  array('label' => 'Fax', 'required' => false))             
            ->add('site_web', TelType::class,  array('label' => 'Site web', 'required' => false))

            ->add('email_general', EmailType::class,  array('label' => 'Email général', 'required' => false))
            ->add('email_alertes', EmailType::class,  array('label' => 'Email des alertes', 'required' => false))             
            ->add('url_facebook', TextType::class,  array('label' => 'Url Facebook', 'required' => false))
            ->add('url_twitter', TextType::class,  array('label' => 'Url Twitter', 'required' => false))
            ->add('url_instagram', TextType::class,  array('label' => 'Url Instagram', 'required' => false))           
            ->add('url_youtube', TextType::class,  array('label' => 'Url Youtube', 'required' => false))
            ->add('url_linkedin', TextType::class,  array('label' => 'Url Linkedin', 'required' => false))
            // Bouton Submit //
            ->add('save', SubmitType::class, array('label' => 'ENREGISTRER'))->getForm();
	}
}
?>

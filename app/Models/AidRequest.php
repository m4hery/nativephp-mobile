<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AidRequest extends Model
{
     use HasFactory, SoftDeletes;

    const STATUS_VALIDATED = "Validée" ;
    const STATUS_REJECTED = "Rejetée" ;
    const STATUS_DISTRIBUTION_EN_COURS = "Distribution en cours" ;
    const STATUS_TRANSMIS = "Transmis" ;
    const STATUS_PENDING = "En attente";
    const STATUS_TERMINEE = "Terminée" ;

    protected $fillable = [
        'local_id',
        'orientation_id',
        'beneficiary_id',
        'prescriber_id',
        'prescriber_type',
        'structure_id',
        'folder_id',
        'charges',
        'living_conditions',
        'administrative_situation',
        'laws_procedures_in_progress',
        'membership_health',
        'atelier',
        'description',
        'accompaniments',
        'status',
        'number_of_children',
        'intervenant',
        'date_debut',
        'date_fin',
        'service_id',
        'personne_adressee',
        'categorie_lait',
        'renouvellement_orientation',
        'motif_medical_orientation',
        'identite_enfant',
        'nom_prenom_enfant',
        'date_naissance_enfant',
        'nom_prenom_responsable',
        'date_naissance_responsable',
        'lieu_habitation_responsable',
        'telephone_responsable',
        'aide_alimentaire',
        'logement',
        'statut_occupation',
        'acces_eau',
        'acces_electricite',
        'is_urgent',
        'has_children',
        'has_futur_children',
        'number_children',
        'other_aidRequest',
        'other_aidRequest_name',
        // Nouveaux champs ajoutés précédemment
        'demandeur',
        'demandeur_date_validite',
        'demandeur_autre_detail',
        'conjoint',
        'conjoint_date_validite',
        'conjoint_autre_detail',
        'connu',
        'remarques_dispositif',
        'association_intervention',
        'association_referent',
        'ccas_intervention',
        'ccas_referent',
        'hopital_intervention',
        'hopital_referent',
        'justice_intervention',
        'justice_referent',
        'ase_intervention',
        'ase_referent',
        'mission_locale_intervention',
        'mission_locale_referent',
        'tutelle_intervention',
        'tutelle_referent',
        'autre_partenaire',
        'autre_intervention',
        'autre_referent',
        'montant_salaire',
        'montant_bricoles',
        'montant_retraite',
        'montant_chomage',
        'montant_familiale',
        'montant_allocation_logement',
        'montant_rsa',
        'montant_aah',
        'montant_aeeh',
        'montant_aspa',
        'montant_formation',
        'montant_garantie_jeune',
        'autre_ressource',
        'montant_autre_ressource',
        'total_ressources',
        'montant_loyer',
        'montant_eau',
        'montant_electricite',
        'montant_gaz',
        'montant_telephone',
        'montant_transport',
        'distribution_session_id',
        'validated_by',
        'validated_at',
        'montant_assurance',
        'montant_impots',
        'autre_charge',
        'montant_autre_charge',
        'total_charges',
        'notice_sociale',
        // Nouveaux champs coordonnées du demandeur
        'adresse_hebergement',
        'portable',
        'is_sync',
        'server_id',
    ];

    protected $casts = [
        'accompaniments' => 'array',
        'date_debut' => 'datetime',
        'date_fin' => 'datetime',
        'validated_at' => 'datetime',
    ];
}

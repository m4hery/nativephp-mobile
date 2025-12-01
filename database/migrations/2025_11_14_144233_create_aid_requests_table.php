<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aid_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('server_id')->nullable()->unique();
          $table->string('local_id')->nullable();

            $table->unsignedBigInteger('distribution_session_id')->nullable();
            $table->unsignedBigInteger('validated_by')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->unsignedBigInteger('orientation_id')->nullable();

            $table->text('charges')->nullable();
            $table->text('living_conditions')->nullable();
            $table->text('administrative_situation')->nullable();
            $table->text('laws_procedures_in_progress')->nullable();
            $table->text('membership_health')->nullable();

            $table->enum('atelier', ['Oui', 'Non'])->default('Non');

            $table->text('description')->nullable();
            $table->json('accompaniments')->nullable(); // JSON CHECK later

            $table->string('status')->default('Brouillon');

            $table->string('number_of_children')->nullable();
            $table->string('intervenant')->nullable();
            $table->string('date_debut')->nullable();
            $table->string('date_fin')->nullable();

            $table->softDeletes();
            $table->timestamps();

            $table->unsignedBigInteger('beneficiary_id')->nullable();
            $table->bigInteger('prescriber_id')->nullable();
            $table->string('prescriber_type')->nullable();
            $table->unsignedBigInteger('structure_id')->nullable();
            $table->unsignedBigInteger('folder_id')->nullable();
            $table->bigInteger('service_id')->nullable();
            $table->boolean('is_urgent')->default(0);

            $table->string('personne_adressee')->nullable();
            $table->string('categorie_lait')->nullable();
            $table->string('renouvellement_orientation')->nullable();

            $table->longText('motif_medical_orientation')->nullable();
            $table->string('identite_enfant')->nullable();
            $table->string('nom_prenom_enfant')->nullable();
            $table->date('date_naissance_enfant')->nullable();
            $table->string('nom_prenom_responsable')->nullable();
            $table->date('date_naissance_responsable')->nullable();
            $table->string('lieu_habitation_responsable')->nullable();
            $table->string('telephone_responsable')->nullable();

            $table->string('aide_alimentaire')->nullable();
            $table->string('logement')->nullable();
            $table->string('statut_occupation')->nullable();
            $table->string('acces_eau')->nullable();
            $table->string('acces_electricite')->nullable();

            $table->unsignedBigInteger('user_id')->nullable();

            $table->string('has_children')->nullable();
            $table->string('has_futur_children')->nullable();
            $table->string('number_children')->nullable();

            $table->string('other_aidRequest')->nullable();
            $table->string('other_aidRequest_name')->nullable();

            $table->boolean('is_sync')->default(1);

            $table->enum('demandeur', [
                'demandeur_cin',
                'demandeur_carte_resident',
                'demandeur_titre_sejour',
                'demandeur_recepisse',
                'demandeur_autre'
            ])->nullable();

            $table->date('demandeur_date_validite')->nullable();
            $table->string('demandeur_autre_detail')->nullable();

            $table->enum('conjoint', [
                'conjoint_cni',
                'conjoint_carte_resident',
                'conjoint_titre_sejour',
                'conjoint_recepisse',
                'conjoint_autre'
            ])->nullable();

            $table->date('conjoint_date_validite')->nullable();
            $table->string('conjoint_autre_detail')->nullable();

            $table->enum('connu', ['oui', 'non'])->nullable();

            $table->text('remarques_dispositif')->nullable();
            $table->string('association_intervention')->nullable();
            $table->string('association_referent')->nullable();
            $table->string('ccas_intervention')->nullable();
            $table->string('ccas_referent')->nullable();
            $table->string('hopital_intervention')->nullable();
            $table->string('hopital_referent')->nullable();
            $table->string('justice_intervention')->nullable();
            $table->string('justice_referent')->nullable();
            $table->string('ase_intervention')->nullable();
            $table->string('ase_referent')->nullable();
            $table->string('mission_locale_intervention')->nullable();
            $table->string('mission_locale_referent')->nullable();
            $table->string('tutelle_intervention')->nullable();
            $table->string('tutelle_referent')->nullable();
            $table->string('autre_partenaire')->nullable();
            $table->string('autre_intervention')->nullable();
            $table->string('autre_referent')->nullable();

            $money = [
                'montant_salaire', 'montant_bricoles', 'montant_retraite',
                'montant_chomage', 'montant_familiale', 'montant_allocation_logement',
                'montant_rsa', 'montant_aah', 'montant_aeeh', 'montant_aspa',
                'montant_formation', 'montant_garantie_jeune',
                'montant_autre_ressource', 'total_ressources',
                'montant_loyer', 'montant_eau', 'montant_electricite', 'montant_gaz',
                'montant_telephone', 'montant_transport', 'montant_assurance',
                'montant_impots', 'montant_autre_charge', 'total_charges'
            ];

            foreach ($money as $col) {
                $table->decimal($col, 10, 2)->nullable();
            }

            $table->string('autre_ressource')->nullable();
            $table->string('autre_charge')->nullable();

            $table->text('notice_sociale')->nullable();
            $table->text('adresse_hebergement')->nullable();
            $table->string('portable')->nullable();

            // Foreign keys
            $table->foreign('beneficiary_id')->references('server_id')->on('beneficiaries')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('distribution_session_id')->references('server_id')->on('distribution_sessions')->nullOnDelete();
            $table->foreign('orientation_id')->references('server_id')->on('orientations')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('folder_id')->references('server_id')->on('folders')->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreign('structure_id')->references('server_id')->on('structures')->cascadeOnDelete()->cascadeOnUpdate();

            $table->foreign('user_id')->references('server_id')->on('users')->cascadeOnDelete();
            $table->foreign('validated_by')->references('server_id')->on('users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aid_requests');
    }
};

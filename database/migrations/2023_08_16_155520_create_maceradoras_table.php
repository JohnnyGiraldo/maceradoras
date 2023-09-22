<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('maceradoras', function (Blueprint $table) {
            $table->string('serial')->primary()->unique();
            $table->string('modelo', 255);
            $table->string('estado', 255);
            $table->date('fechaFabricacion');
            $table->string('tipoAsistencia', 255);
            $table->date('fechaInstalacion');
            $table->string('tipoMantenimiento', 255);
            $table->date('fechaMantenimiento');
            $table->string('tipoPieza', 255);
            $table->date('fechaCambioPieza');
            $table->integer('numeroCiclos')->unsigned(); 
            $table->date('fechaIncidente');
            $table->text('observaciones')->nullable();
            $table->string('img')->nullable();
            
            $table->foreignId('cliente_id')
            ->constrained('clientes')
            ->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maceradoras');
    }
};


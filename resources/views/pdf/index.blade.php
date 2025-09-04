{{-- resources/views/pdf/selection.blade.php --}}
@extends('layouts.template')

@section('title', 'Generer un pdf')
@section('content')

    <div class="container mt-4">
        <div class="card shadow rounded">
            <div class="card-header bg-primary text-white">
                <h2>Générer un PDF</h2>
            </div>
            <div class="card-body">

                <div class="mb-3">
                    <label for="type_document">Type de document</label>
                    <select id="type_document" class="form-control">
                        <option value="">-- Sélectionnez --</option>
                        <option value="avis">Avis</option>
                        <option value="deliberation">Délibération</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="document_id">Document</label>
                    <select id="document_id" class="form-control" disabled>
                        <option value="">-- Choisissez un document --</option>
                    </select>
                </div>

                <button id="download_pdf" class="btn btn-primary" disabled>Télécharger le PDF</button>
            </div>
        </div>
    </div>

@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    // $(document).ready(function(){
    //     console.log('Script chargé'); // Test 1

    //     // Quand on change le type de document
    //     $('#type_document').on('change', function(){
    //         let type = $(this).val();
    //         console.log('Type sélectionné:', type); // Test 2

    //         $('#document_id').prop('disabled', true).html('<option value="">-- Chargement... --</option>');
    //         $('#download_pdf').prop('disabled', true);

    //         if(type){
    //             console.log('Avant appel AJAX'); // Test 3

    //             $.ajax({
    //                 url: "{{ route('pdf.getDocuments') }}",
    //                 method: 'GET',
    //                 data: { type: type },
    //                 beforeSend: function() {
    //                     console.log('Requête envoyée'); // Test 4
    //                 },
    //                 success: function(data){
    //                     console.log('SUCCESS - Données reçues:', data); // Test 5
    //                     console.log('Type des données:', typeof data);
    //                     console.log('Longueur:', data.length);

    //                     $('#document_id').html('<option value="">-- Choisissez un document --</option>');

    //                     if(data && data.length > 0) {
    //                         $.each(data, function(index, doc){
    //                             console.log('Document ' + index + ':', doc);
    //                             $('#document_id').append('<option value="'+doc.id+'">'+(doc.numero ?? 'Sans titre')+'</option>');
    //                         });
    //                         $('#document_id').prop('disabled', false);
    //                         console.log('Select rempli et activé');
    //                     } else {
    //                         console.log('Aucun document trouvé');
    //                         $('#document_id').html('<option value="">-- Aucun document --</option>');
    //                     }
    //                 },
    //                 error: function(xhr, status, error) {
    //                     console.error('ERREUR AJAX:');
    //                     console.error('Status:', status);
    //                     console.error('Error:', error);
    //                     console.error('Response:', xhr.responseText);
    //                     console.error('Status Code:', xhr.status);
    //                     $('#document_id').html('<option value="">-- Erreur de chargement --</option>');
    //                 },
    //                 complete: function() {
    //                     console.log('Requête terminée'); // Test 6
    //                 }
    //             });
    //         } else {
    //             $('#document_id').html('<option value="">-- Choisissez un document --</option>').prop('disabled', true);
    //         }
    //     });

    //     // Reste de ton code...
    //     $('#document_id').on('change', function(){
    //         $('#download_pdf').prop('disabled', !$(this).val());
    //     });

    //     $('#download_pdf').on('click', function(){
    //         let type = $('#type_document').val();
    //         let id = $('#document_id').val();

    //         if(type && id){
    //             window.location.href = "{{ url('/pdf/download') }}/" + type + "/" + id;
    //         }
    //     });
    // });

    $(document).ready(function(){
    console.log('Script chargé'); // Test 1

    // Quand on change le type de document
    $('#type_document').on('change', function(){
        let type = $(this).val();
        console.log('Type sélectionné:', type); // Test 2

        $('#document_id').prop('disabled', true).html('<option value="">-- Chargement... --</option>');
        $('#download_pdf').prop('disabled', true);

        if(type){
            console.log('Avant appel AJAX'); // Test 3

            $.ajax({
                url: "{{ route('pdf.getDocuments') }}", // Route unique pour récupérer docs
                method: 'GET',
                data: { type: type }, // On envoie le type (avis ou deliberations)
                beforeSend: function() {
                    console.log('Requête envoyée'); // Test 4
                },
                success: function(data){
                    console.log('SUCCESS - Données reçues:', data); // Test 5
                    $('#document_id').html('<option value="">-- Choisissez un document --</option>');

                    if(data && data.length > 0) {
                        $.each(data, function(index, doc){
                            let libelle = '';

                            // Si c'est une délibération
                            if(type === 'deliberation'){
                                libelle = doc.numero ?? 'Sans numéro';
                            }

                            // Si c'est un avis
                            if(type === 'avis'){
                                libelle = doc.numero_avis ?? 'Sans numéro';
                            }

                            $('#document_id').append('<option value="'+doc.id+'">'+libelle+'</option>');
                        });

                        $('#document_id').prop('disabled', false);
                        console.log('Select rempli et activé');
                    } else {
                        $('#document_id').html('<option value="">-- Aucun document --</option>');
                        console.log('Aucun document trouvé');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('ERREUR AJAX:', xhr.responseText);
                    $('#document_id').html('<option value="">-- Erreur de chargement --</option>');
                },
                complete: function() {
                    console.log('Requête terminée'); // Test 6
                }
            });
        } else {
            $('#document_id').html('<option value="">-- Choisissez un document --</option>').prop('disabled', true);
        }
    });

    // Quand on choisit un document
    $('#document_id').on('change', function(){
        $('#download_pdf').prop('disabled', !$(this).val());
    });

    // Téléchargement du PDF
    $('#download_pdf').on('click', function(){
        let type = $('#type_document').val();
        let id = $('#document_id').val();

        if(type && id){
            window.location.href = "{{ url('/pdf/download') }}/" + type + "/" + id;
        }
    });
});


</script>

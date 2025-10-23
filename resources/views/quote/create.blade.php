@extends('layouts.app')

@section('title', 'Demander un Devis - Caraïbes Voiles Manutention')

@push('styles')
<style>
    .quote-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: calc(100vh - 80px);
    }

    .quote-container {
        max-width: 800px;
        margin: 0 auto;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        padding: 50px;
    }

    .quote-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .quote-header h1 {
        color: #2c3e50;
        font-size: 2.5rem;
        margin-bottom: 15px;
        font-weight: 700;
    }

    .quote-header p {
        color: #7f8c8d;
        font-size: 1.1rem;
    }

    .form-group {
        margin-bottom: 25px;
    }

    .form-label {
        display: block;
        margin-bottom: 8px;
        color: #2c3e50;
        font-weight: 600;
        font-size: 0.95rem;
    }

    .form-label .required {
        color: #e84e9b;
    }

    .form-control, .form-select {
        width: 100%;
        padding: 12px 15px;
        border: 2px solid #e0e6ed;
        border-radius: 10px;
        font-size: 1rem;
        transition: all 0.3s;
    }

    .form-control:focus, .form-select:focus {
        border-color: #e84e9b;
        outline: none;
        box-shadow: 0 0 0 3px rgba(232, 78, 155, 0.1);
    }

    textarea.form-control {
        resize: vertical;
        min-height: 120px;
    }

    .invalid-feedback {
        color: #e74c3c;
        font-size: 0.875rem;
        margin-top: 5px;
        display: block;
    }

    .btn-submit {
        background: linear-gradient(135deg, #e84e9b 0%, #c53d7d 100%);
        color: white;
        border: none;
        padding: 15px 40px;
        font-size: 1.1rem;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s;
        width: 100%;
        font-weight: 600;
        margin-top: 10px;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(232, 78, 155, 0.3);
    }

    .file-upload-wrapper {
        position: relative;
        overflow: hidden;
        display: inline-block;
    }

    .file-info {
        margin-top: 10px;
        padding: 10px;
        background: #f8f9fa;
        border-radius: 8px;
        font-size: 0.9rem;
        color: #555;
    }

    @media (max-width: 768px) {
        .quote-container {
            padding: 30px 20px;
        }

        .quote-header h1 {
            font-size: 2rem;
        }
    }
</style>
@endpush

@section('content')
<div class="quote-section">
    <div class="container">
        <div class="quote-container">
            <div class="quote-header">
                <h1>✨ Demander un Devis</h1>
                <p>Remplissez le formulaire ci-dessous et nous vous répondrons dans les plus brefs délais</p>
            </div>

            <form action="{{ route('quote.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                Nom complet <span class="required">*</span>
                            </label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" 
                                   value="{{ old('name') }}" placeholder="Votre nom" required>
                            @error('name')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                Email <span class="required">*</span>
                            </label>
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" placeholder="votre@email.com" required>
                            @error('email')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                Téléphone <span class="required">*</span>
                            </label>
                            <input type="tel" name="phone" class="form-control @error('phone') is-invalid @enderror" 
                                   value="{{ old('phone') }}" placeholder="0696 XX XX XX" required>
                            @error('phone')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">
                                Type de service <span class="required">*</span>
                            </label>
                            <select name="service_type" class="form-select @error('service_type') is-invalid @enderror" required>
                                <option value="">-- Sélectionner --</option>
                                <option value="voile" {{ old('service_type') == 'voile' ? 'selected' : '' }}>Voile</option>
                                <option value="bache" {{ old('service_type') == 'bache' ? 'selected' : '' }}>Bâche</option>
                                <option value="bimini" {{ old('service_type') == 'bimini' ? 'selected' : '' }}>Bimini</option>
                                <option value="capitonnage_auto" {{ old('service_type') == 'capitonnage_auto' ? 'selected' : '' }}>Capitonnage Auto</option>
                                <option value="capitonnage_moto" {{ old('service_type') == 'capitonnage_moto' ? 'selected' : '' }}>Capitonnage Moto</option>
                                <option value="reparation" {{ old('service_type') == 'reparation' ? 'selected' : '' }}>Réparation</option>
                                <option value="autre" {{ old('service_type') == 'autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('service_type')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Description du projet <span class="required">*</span>
                    </label>
                    <textarea name="description" class="form-control @error('description') is-invalid @enderror" 
                              placeholder="Décrivez votre projet en détail..." required>{{ old('description') }}</textarea>
                    @error('description')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="form-label">
                        Joindre un fichier (optionnel)
                    </label>
                    <input type="file" name="attachment" class="form-control @error('attachment') is-invalid @enderror" 
                           accept=".jpg,.jpeg,.png,.pdf" onchange="showFileName(this)">
                    <small class="text-muted">Formats acceptés: JPG, PNG, PDF (max 5 Mo)</small>
                    <div id="fileName" class="file-info" style="display: none;"></div>
                    @error('attachment')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <button type="submit" class="btn-submit">
                    📧 Envoyer ma demande
                </button>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function showFileName(input) {
        const fileInfo = document.getElementById('fileName');
        if (input.files && input.files[0]) {
            const fileName = input.files[0].name;
            const fileSize = (input.files[0].size / 1024 / 1024).toFixed(2);
            fileInfo.innerHTML = `📎 Fichier sélectionné: <strong>${fileName}</strong> (${fileSize} Mo)`;
            fileInfo.style.display = 'block';
        } else {
            fileInfo.style.display = 'none';
        }
    }
</script>
@endpush
@endsection

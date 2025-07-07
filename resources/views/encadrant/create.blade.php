<x-app-layout>

    <style>
        :root {
            --primary: #4361ee;
            --primary-dark: #3a0ca3;
            --light: #f8f9fa;
            --dark: #212529;
            --gray: #6b7280;
            --border: #e5e7eb;
            --success: #10b981;
            --error: #ef4444;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        body {
            background-color: #f5f7fa;
            color: var(--dark);
            line-height: 1.6;
        }
        
        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 2rem;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }
        
        h2 {
            color: var(--primary);
            margin-bottom: 1.5rem;
            font-size: 1.8rem;
            font-weight: 700;
            text-align: center;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--border);
        }
        
        .alert {
            padding: 1rem;
            margin-bottom: 1.5rem;
            border-radius: 5px;
            font-weight: 500;
        }
        
        .alert-success {
            background-color: rgba(16, 185, 129, 0.1);
            color: var(--success);
            border-left: 4px solid var(--success);
        }
        
        .alert-error {
            background-color: rgba(239, 68, 68, 0.1);
            color: var(--error);
            border-left: 4px solid var(--error);
        }
        
        .error-list {
            list-style-type: none;
            margin-top: 0.5rem;
        }
        
        .error-list li {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.3rem;
        }
        
        .error-list li::before {
            content: "•";
            color: var(--error);
            font-weight: bold;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            color: var(--dark);
        }
        
        .input-field {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 1px solid var(--border);
            border-radius: 6px;
            font-size: 1rem;
            transition: all 0.3s;
        }
        
        .input-field:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(67, 97, 238, 0.2);
        }
        
        .error-message {
            color: var(--error);
            font-size: 0.875rem;
            margin-top: 0.25rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }
        
        .submit-btn {
            background-color: var(--primary);
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 6px;
            cursor: pointer;
            transition: all 0.3s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .submit-btn:hover {
            background-color: var(--primary-dark);
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(67, 97, 238, 0.2);
        }
        
        .submit-btn i {
            font-size: 1rem;
        }
        
        .form-footer {
            margin-top: 2rem;
            text-align: right;
        }
        
        @media (max-width: 768px) {
            .container {
                margin: 1rem;
                padding: 1.5rem;
            }
            
            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2><i class="fas fa-user-plus"></i> Ajouter un Encadrant</h2>

        <!-- Messages de succès -->
        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <!-- Messages d'erreur -->
        @if ($errors->any())
            <div class="alert alert-error">
                <strong><i class="fas fa-exclamation-triangle"></i> Veuillez corriger les erreurs suivantes :</strong>
                <ul class="error-list">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('encadrant.store') }}">
            @csrf

            <div class="form-group">
                <label for="specialite"><i class="fas fa-graduation-cap"></i> Spécialité</label>
                <input type="text" 
                       name="specialite" 
                       id="specialite" 
                       class="input-field" 
                       value="{{ old('specialite') }}"
                       placeholder="Informatique, Gestion, etc.">
                @error('specialite') 
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div> 
                @enderror
            </div>

            <div class="form-group">
                <label for="telephone"><i class="fas fa-phone"></i> Téléphone</label>
                <input type="text" 
                       name="telephone" 
                       id="telephone" 
                       class="input-field" 
                       value="{{ old('telephone') }}"
                       placeholder="+212 6XXXXXXXX">
                @error('telephone') 
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div> 
                @enderror
            </div>

            <div class="form-group">
                <label for="email"><i class="fas fa-envelope"></i> Email</label>
                <input type="email" 
                       name="email" 
                       id="email" 
                       class="input-field" 
                       value="{{ old('email') }}"
                       placeholder="encadrant@example.com">
                @error('email') 
                    <div class="error-message">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div> 
                @enderror
            </div>

            <div class="form-footer">
                <button type="submit" class="submit-btn">
                    <i class="fas fa-save"></i> Enregistrer l'encadrant
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

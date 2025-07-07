<h1>Bonjour {{ $etudiant->nom }}</h1>

<p>Bienvenue sur votre espace personnel.</p>

<p>Nous sommes ravis de vous compter parmi nous.</p>

<p>
    <a href="{{ route('etudiant.dashboard') }}" 
       style="display: inline-block; padding: 10px 20px; background-color: #3490dc; color: white; text-decoration: none; border-radius: 5px;">
        Accéder à mon espace
    </a>
</p>

<p>Cordialement,<br>L’équipe ENSAM</p>

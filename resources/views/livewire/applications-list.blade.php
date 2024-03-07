<div>
@foreach ($jobs as $application)
    <div>
        <p>Nombre del candidato: {{ $application->user->name }}</p>
        <p>Trabajo aplicado: {{ $application->job->tittle }}</p>
        <p>Descripción del trabajo: {{ $application->job->description }}</p>
        <!-- Agrega más detalles según sea necesario -->
    </div>
@endforeach
</div>

<div class="card card-session mb-3">
    <div style="background-image: url('{{ $session->getImage() }}')"
         class="campaign-card-header">
    </div>
    <div class="card-body">
        <h5 class="session-title">{{ str_limit($session->name, 30) }}</h5>
        <span class="session-details">{{ $session->date->diffForHumans() }} ({{ $session->date->isoFormat('D MMM YYYY') }}), <a href="{{ route('users.show', $session->user->id) }}">{{ $session->user->name }}</a></span>
        <p class="card-text session-description">
            {{ str_limit(strip_tags($session->text), 100) }}
        </p>
    </div>
    <div class="card-footer">
        <a href="{{ route('sessions.show', $session->id) }}" class="btn btn-primary btn-sm">Ver sesión</a>
        <div class="float-right">
            <span class="badge text-success reaction"><i class="fa fa-thumbs-up"></i> {{ $session->positives()->count() }}</span>
            <span class="badge text-danger reaction"><i class="fa fa-thumbs-down"></i> {{ $session->negatives()->count() }}</span>
        </div>
    </div>
</div>
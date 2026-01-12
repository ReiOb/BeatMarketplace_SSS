@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-12 col-md-8">
        <div class="card shadow-sm">
            <div class="card-body">
                <h1 class="h2 mb-4">Follow & Connect</h1>

                <p class="text-muted mb-4">
                    Stay updated with new beats, features, and community highlights.
                    Follow us on social media.
                </p>

                <div class="list-group">
                    <a href="https://x.com/fruktovics" target="_blank" rel="noopener" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">
                                    <i class="bi bi-twitter"></i> Developer's Twitter / X
                                </h6>
                                <p class="text-muted small mb-0">@fruktovics</p>
                            </div>
                            <span class="badge bg-primary">Follow</span>
                        </div>
                    </a>

                    <a href="https://soundcloud.com/brukc" target="_blank" rel="noopener" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">
                                    <i class="bi bi-soundwave"></i> Developer's SoundCloud Profile
                                </h6>
                                <p class="text-muted small mb-0">@brukc</p>
                            </div>
                            <span class="badge bg-danger">Follow :] </span>
                        </div>
                    </a>

                    <a href="https://www.instagram.com/reinis_obuhovics/" target="_blank" rel="noopener" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">
                                    <i class="bi bi-instagram"></i> Instagram
                                </h6>
                                <p class="text-muted small mb-0">@reinis_obuhovics</p>
                            </div>
                            <span class="badge bg-danger">Follow</span>
                        </div>
                    </a>

                    <a href="https://youtube.com" target="_blank" rel="noopener" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">
                                    <i class="bi bi-youtube"></i> YouTube
                                </h6>
                                <p class="text-muted small mb-0">@beatmarketplace</p>
                            </div>
                            <span class="badge bg-danger">Subscribe</span>
                        </div>
                    </a>

                    <a href="https://discord.com" target="_blank" rel="noopener" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">
                                    <i class="bi bi-discord"></i> Discord
                                </h6>
                                <p class="text-muted small mb-0">Join our community server</p>
                            </div>
                            <span class="badge bg-info">Join</span>
                        </div>
                    </a>

                    <a href="mailto:hello@beatmarketplace.com" class="list-group-item list-group-item-action">
                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <h6 class="mb-1">
                                    <i class="bi bi-envelope"></i> Email
                                </h6>
                                <p class="text-muted small mb-0">beatmarket@mail.com</p>
                            </div>
                            <span class="badge bg-secondary">Contact</span>
                        </div>
                    </a>
                </div>

                <hr class="my-4">

                <h5 class="mb-3">Community</h5>
                <p class="text-muted">
                    Join thousands of producers and musicians sharing beats and collaborating.
                    Have questions? Want to report a bug? Reach out to us anytime, and we'd love to hear from you!
                </p>

                <a href="mailto:support@beatmarketplace.com" class="btn btn-outline-primary">
                    Contact Support
                </a>
            </div>
        </div>
    </div>
</div>
@endsection

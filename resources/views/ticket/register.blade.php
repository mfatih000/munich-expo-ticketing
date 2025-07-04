@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4 d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Munich EXPO Ticket Registration</h4>
            <a href="{{ route('admin.registrations') }}" class="btn btn-light btn-sm text-primary fw-semibold">
                Admin Login
            </a>
        </div>

        <div class="card-body p-5">

            {{-- Başarı mesajı --}}
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif

            {{-- Validation hataları --}}
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('ticket.store') }}" method="POST" novalidate id="registrationForm">
                @csrf

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="first_name" class="form-label fw-semibold">First Name <span class="text-danger">*</span></label>
                        <input type="text" name="first_name" id="first_name" class="form-control form-control-lg @error('first_name') is-invalid @enderror" value="{{ old('first_name') }}" required>
                        @error('first_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="last_name" class="form-label fw-semibold">Last Name <span class="text-danger">*</span></label>
                        <input type="text" name="last_name" id="last_name" class="form-control form-control-lg @error('last_name') is-invalid @enderror" value="{{ old('last_name') }}" required>
                        @error('last_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="email" class="form-label fw-semibold">Professional Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" id="email" class="form-control form-control-lg @error('email') is-invalid @enderror" value="{{ old('email') }}" required>
                        <div class="form-text">Please use your work email address.</div>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="phone" class="form-label fw-semibold">Phone</label>
                        <input type="tel" name="phone" id="phone" class="form-control form-control-lg @error('phone') is-invalid @enderror" value="{{ old('phone') }}">
                        @error('phone')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                {{-- Diğer alanlar --}}
                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="job_title" class="form-label fw-semibold">Job Title</label>
                        <input type="text" name="job_title" id="job_title" class="form-control form-control-lg @error('job_title') is-invalid @enderror" value="{{ old('job_title') }}">
                        @error('job_title')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="company" class="form-label fw-semibold">Company</label>
                        <input type="text" name="company" id="company" class="form-control form-control-lg @error('company') is-invalid @enderror" value="{{ old('company') }}">
                        @error('company')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row g-3 mb-4">
                    <div class="col-md-6">
                        <label for="country" class="form-label fw-semibold">Country</label>
                        <input type="text" name="country" id="country" class="form-control form-control-lg @error('country') is-invalid @enderror" value="{{ old('country') }}">
                        @error('country')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label for="linkedin" class="form-label fw-semibold">LinkedIn URL</label>
                        <input type="url" name="linkedin" id="linkedin" class="form-control form-control-lg @error('linkedin') is-invalid @enderror" value="{{ old('linkedin') }}">
                        @error('linkedin')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="mb-4">
                    <label for="industry" class="form-label fw-semibold">Industry</label>
                    <select name="industry" id="industry" class="form-select form-select-lg @error('industry') is-invalid @enderror">
                        <option value="">-- Select Industry --</option>
                        @foreach(['Technology', 'Finance', 'Healthcare', 'Education', 'Manufacturing'] as $ind)
                        <option value="{{ $ind }}" {{ old('industry') == $ind ? 'selected' : '' }}>{{ $ind }}</option>
                        @endforeach
                    </select>
                    @error('industry')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold d-block mb-2">Company Size</label>
                    @foreach(['1-10', '11-50', '51-200', '200+'] as $size)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('company_size') is-invalid @enderror" type="radio" name="company_size" id="size_{{ $size }}" value="{{ $size }}" {{ old('company_size') == $size ? 'checked' : '' }}>
                        <label class="form-check-label" for="size_{{ $size }}">{{ $size }}</label>
                    </div>
                    @endforeach
                    @error('company_size')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold d-block mb-2">Years of Experience</label>
                    @foreach(['0-2', '3-5', '6-10', '10+'] as $exp)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('experience') is-invalid @enderror" type="radio" name="experience" id="exp_{{ $exp }}" value="{{ $exp }}" {{ old('experience') == $exp ? 'checked' : '' }}>
                        <label class="form-check-label" for="exp_{{ $exp }}">{{ $exp }}</label>
                    </div>
                    @endforeach
                    @error('experience')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold d-block mb-2">Interests</label>
                    @foreach(['recruitment', 'investment', 'speaking', 'networking', 'sponsorship'] as $interest)
                    <div class="form-check form-check-inline">
                        <input class="form-check-input @error('interests') is-invalid @enderror" type="checkbox" name="interests[]" id="interest_{{ $interest }}" value="{{ $interest }}" {{ (is_array(old('interests')) && in_array($interest, old('interests'))) ? 'checked' : '' }}>
                        <label class="form-check-label text-capitalize" for="interest_{{ $interest }}">{{ $interest }}</label>
                    </div>
                    @endforeach
                    @error('interests')
                    <div class="invalid-feedback d-block">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="meeting_topics" class="form-label fw-semibold">1:1 Meeting Topics</label>
                    <select class="form-select form-select-lg @error('meeting_topics') is-invalid @enderror" name="meeting_topics[]" id="meeting_topics" multiple size="5" aria-label="1:1 Meeting Topics">
                        @foreach(['Recruitment', 'Funding', 'Partnerships', 'Technology', 'HR Tech', 'Market Expansion'] as $topic)
                        <option value="{{ $topic }}" {{ (is_array(old('meeting_topics')) && in_array($topic, old('meeting_topics'))) ? 'selected' : '' }}>{{ $topic }}</option>
                        @endforeach
                    </select>
                    @error('meeting_topics')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-4">
                    <label class="form-label fw-semibold d-block mb-2">Communication Preferences</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="consent_newsletter" id="consent_newsletter" {{ old('consent_newsletter') ? 'checked' : '' }}>
                        <label class="form-check-label" for="consent_newsletter">I agree to receive event updates.</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="consent_thirdparty" id="consent_thirdparty" {{ old('consent_thirdparty') ? 'checked' : '' }}>
                        <label class="form-check-label" for="consent_thirdparty">I agree to share my contact info with partners.</label>
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-lg btn-primary px-5">Submit Registration</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('registrationForm');
        form.addEventListener('submit', function(e) {
            let errors = [];

            // Basit client-side validation
            const firstName = form.first_name.value.trim();
            const lastName = form.last_name.value.trim();
            const email = form.email.value.trim();

            if (!firstName) errors.push("First Name is required.");
            if (!lastName) errors.push("Last Name is required.");

            if (!email) {
                errors.push("Email is required.");
            } else {
                const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailPattern.test(email)) {
                    errors.push("Email format is invalid.");
                }
            }

            if (errors.length) {
                e.preventDefault();
                alert(errors.join("\n"));
            }
        });
    });
</script>
@endsection
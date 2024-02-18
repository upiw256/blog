<div>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif
    <form wire:submit.prevent="store" class="php-email-form">
        @csrf
        <div class="row">
            <div class="col-md-6 form-group">
                <input type="text" wire:model="name" class="form-control"placeholder="Your Name" required>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" wire:model="email" placeholder="Your Email" required>
            </div>
        </div>
        <div class="form-group mt-3">
            <input type="text" class="form-control" wire:model="subject" placeholder="Subject" required>
        </div>
        <div class="form-group mt-3">
            <textarea class="form-control" wire:model="message" rows="5" placeholder="Message" required></textarea>
        </div>
        
        <div class="text-center"><button type="submit" id="submitButton">Send Message</button></div>
            <input type="hidden" id="recaptchaToken" name="recaptchaToken">
    </form>

</div>

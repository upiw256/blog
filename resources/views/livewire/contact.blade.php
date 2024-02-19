<div>
    <form wire:submit.prevent="store" class="php-email-form" id="contactForm">
        @csrf
        <div class="row">
            <div class="col-md-6 form-group">
              <input type="text" wire:model="name" class="form-control" placeholder="Your Name" required>
              <div>@error('name') {{ $this->errors->first('name') }} @enderror</div>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0">
              <input type="email" class="form-control" wire:model="email" placeholder="Your Email" required>
              <div>@error('email') {{ $this->errors->first('email') }} @enderror</div>
            </div>
          </div>
          <div class="form-group mt-3">
            <input type="text" class="form-control" wire:model="subject" placeholder="Subject">
            <div>@error('subject') {{ $this->errors->first('subject') }} @enderror</div>
          </div>
          <div class="form-group mt-3">
            <textarea class="form-control" wire:model="message" rows="5" placeholder="Share your feedback in detail" required></textarea>
            <div>@error('message') {{ $this->errors->first('message') }} @enderror</div>
          </div>
          <div class="form-group mt-3">
            <span><img src="{{ route('captcha') }}" alt="Captcha"></span>
            <input type="text" wire:model="captcha" id="captcha" class="form-control mt-3" required>
            <div>@error('captcha') {{ $this->errors->first('captcha') }} @enderror</div>
          </div>
          <div class="text-center">
            <button type="submit">Submit Feedback</button>
          </div>
    </form>  
</div>

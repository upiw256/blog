<div>
    <form wire:submit.prevent="store" class="php-email-form bg-custom" id="contactForm" class="p-3">
        @csrf
          <div class="row bg-custom">
            <div class="col-md-6 form-group bg-custom">
              <input type="text" wire:model.blur="name" class="form-control" placeholder="Your Name" required>
              <div>@error('name') {{ $this->errors->first('name') }} @enderror</div>
            </div>
            <div class="col-md-6 form-group mt-3 mt-md-0 bg-custom">
              <input type="email" class="form-control" wire:model.blur="email" placeholder="Your Email" required>
              <div>@error('email') {{ $this->errors->first('email') }} @enderror</div>
            </div>
          </div>
          <div class="col bg-custom">
            <div class="form-group mt-3 ">
              <input type="text" class="form-control " wire:model.blur="subject" placeholder="Subject">
              <div>@error('subject') {{ $this->errors->first('subject') }} @enderror</div>
            </div>
            <div class="form-group mt-3 bg-custom">
              <textarea class="form-control" wire:model.blur="message" rows="5" placeholder="Share your feedback in detail" required></textarea>
              <div>@error('message') {{ $this->errors->first('message') }} @enderror</div>
            </div>
          </div>
          <div class="col bg-custom">
            <div class="form-group mt-3 bg-custom">
              <span class="d-flex "><img src="{{ $captchaUrl }}" alt="Captcha"><a href="javascript:void(0);" class="btn btn-danger m-3" wire:click.prevent="refreshCaptcha()">Refresh Captcha</a></span>
              <input type="text" wire:model.blur="captcha" id="captcha" class="form-control mt-3" placeholder="Captcha" required>
              <div class="text-danger">@error('captcha') {!! 'capcha tidak sama sialhkan refresh captcha' !!} @enderror</div>
              
            </div>
            <div class="text-center bg-custom">
              <button type="submit">Submit Feedback</button>
            </div>
          </div>
          
    </form>  
</div>

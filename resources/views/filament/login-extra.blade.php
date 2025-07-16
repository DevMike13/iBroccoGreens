{{-- @if (request()->is('ibroccogreens-admin/register'))
  <div class="illustration-wrapper">
    <img src="{{ asset('images/pana.png') }}" alt="" class="left-illustration-registration">
  </div>
@else
  <div class="illustration-wrapper">
    <img src="{{ asset('images/Illustration-1.png') }}" alt="" class="left-illustration-login">
  </div>
@endif --}}




<div class="illustration-wrapper">
  @if (request()->is('ibroccogreens-admin/register'))
      <img src="{{ asset('images/pana.png') }}" alt="" class="left-illustration-registration illustration-image">
  @else
      <img src="{{ asset('images/Illustration-1.png') }}" alt="" class="left-illustration-login illustration-image">
  @endif

  @for ($i = 0; $i < 20; $i++)
      <img
          src="{{ asset('images/micro-leaf.png') }}"
          class="broccoli near-illustration"
          style="
              left: {{ rand(0, 100) }}%;
              animation-delay: {{ rand(0, 5000) / 1000 }}s;
              animation-duration: {{ rand(3000, 7000) / 1000 }}s;
              width: {{ rand(20, 50) }}px;
          "
      />
  @endfor
</div>



<style>
body {
    height: 100vh;
    overflow: hidden;
    background: linear-gradient(0deg, #e5e7eb 0%, rgba(229, 231, 235, 0) 100%) !important;
    position: relative;
}

.left-illustration-login,
.left-illustration-registration {
  display: none;
}
/* @media screen and (max-width: 1023px) {
  .custom-terms-button-input {
    margin-left: -90px !important;
    margin-top: 2px !important;
    display: inline-block;
  }
} */


@media screen and (min-width: 1024px) {
    main {
      position: absolute; right: 100px;
    
    }
    .custom-tems-button-input{
      margin-left: -99px !important;
      margin-top: 1.5px;
    }
    .illustration-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 50%;
        height: 100vh;
        overflow: hidden;
        z-index: 1;
        pointer-events: none;
    }

    .illustration-image {
        position: absolute;
        left: 100px;
        top: 50px;
        width: 350px;
        height: auto;
        z-index: 2;
        pointer-events: auto;
    }

    .left-illustration-login,
    .left-illustration-registration {
        display: block;
        /* position: relative;
        width: 100%; */
        z-index: 2;
    }

    .broccoli {
        position: absolute;
        top: -100px;
        animation: drop-broccoli 5s linear infinite;
        opacity: 0.9;
        z-index: 0;
        pointer-events: none;
    }


}
    
.broccoli {
  position: absolute;
  top: -100px;
  width: 40px;
  animation: drop-broccoli 5s linear infinite;
  z-index: -1;
  opacity: 0.9;
}
@media screen and (max-width: 1023px) {
  .custom-tems-button-input {
      margin-left: -200px !important;
      margin-top: 3px !important;
  }
}
/* Additional clones for effect */
/* .broccoli::before,
.broccoli::after {
    content: '';
    background-image: url('{{ asset('images/broccoli.svg') }}');
    background-size: contain;
    background-repeat: no-repeat;
    position: absolute;
    width: 40px;
    height: 40px;
    opacity: 0.6;
    animation: drop-broccoli 7s linear infinite;
} */

/* Animation */
@keyframes drop-broccoli {
    0% {
        transform: translateY(-100px) rotate(0deg);
        opacity: 1;
    }
    100% {
        transform: translateY(110vh) rotate(360deg);
        opacity: 0;
    }
}
</style>
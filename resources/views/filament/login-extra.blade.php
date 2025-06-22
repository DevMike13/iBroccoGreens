
@if (request()->is('ibroccogreens-admin/register'))
  <img src="{{ asset('images/pana.png') }}" alt="" class="left-illustration-registration">
@else
  <img src="{{ asset('images/Illustration-1.png') }}" alt="" class="left-illustration-login">
@endif



@for ($i = 0; $i < 20; $i++)
  <img
      src="{{ asset('images/broccoli.svg') }}"
      class="broccoli"
      style="
          left: {{ rand(0, 100) }}%;
          animation-delay: {{ rand(0, 5000) / 1000 }}s;
          animation-duration: {{ rand(3000, 7000) / 1000 }}s;
          width: {{ rand(20, 50) }}px;
      "
  />
@endfor


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

@media screen and (min-width: 1024px) {
    main {
      position: absolute; right: 100px;
    }

    .left-illustration-login,
    .left-illustration-registration {
      display: block;
    }

    .left-illustration-login {
      position: fixed;
      left: 100px;
      width: 350px;
      z-index: 1;
    }

    .left-illustration-registration {
      position: fixed;
      left: 100px;
      width: 350px;
      margin-top: 25px;
      z-index: 1;
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

/* Additional clones for effect */
.broccoli::before,
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
}

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
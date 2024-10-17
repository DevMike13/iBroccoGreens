
<svg
    id="wave"
    xmlns="http://www.w3.org/2000/svg"
    xmlns:xlink="http://www.w3.org/1999/xlink"
    viewBox="0 24 150 28"
    preserveAspectRatio="none"
>
  <defs>
    <path
      id="gentle-wave"
      d="M-160 44c30 0 
      58-18 88-18s
      58 18 88 18 
      58-18 88-18 
      58 18 88 18
      v44h-352z"
    />
  </defs>

  <g class="waves">
    <use
      xlink:href="#gentle-wave"
      x="50"
      y="0"
      fill="#03ffff"
      class="animate-move-forever opacity-20"
    />
    <use
      xlink:href="#gentle-wave"
      x="50"
      y="3"
      fill="#03ffff"
      class="animate-move-slow opacity-50 -delay-3000"
    />
    <use
      xlink:href="#gentle-wave"
      x="50"
      y="6"
      fill="#03ffff"
      class="animate-move-fast opacity-90 -delay-4000"
    />
  </g>
</svg>

<style>
body {
    height: 100vh;
    background: rgb(34,193,195) !important;
    background: linear-gradient(0deg, rgba(30, 58, 138) 0%, rgb(30 58 138 / 0) 100%)  !important;;
}

@media screen and (min-width: 1024px) {
    main {
        position: absolute; right: 100px;
    }

    main:before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: darkcyan;
        border-radius: 12px;
        z-index: -9;

        /*box-shadow: -50px 80px 4px 10px #555;*/
        -webkit-transform: rotate(7deg);
        -moz-transform: rotate(7deg);
        -o-transform: rotate(7deg);
        -ms-transform: rotate(7deg);
        transform: rotate(7deg);
    }
    .fi-logo {
        position: fixed;
        left: 100px;
        font-size: 3em;
        color: cornsilk;
    }

}
    #wave{
        position: fixed;
        left: 0;
        bottom: 0;
        width: 100vw;
        z-index: -200 !important;
    }
    

    .waves > use {
        animation: move-forever 2s -2s linear infinite;
    }

    .waves > use:nth-child(2) {
        animation-delay: -3s;
        animation-duration: 6s;
    }
    .waves > use:nth-child(3) {
        animation-delay: -4s;
        animation-duration: 3s;
    }

    @keyframes move-forever {
        0% {
            transform: translate(-90px, 0%);
        }
        100% {
            transform: translate(85px, 0%);
        }
    }
</style>
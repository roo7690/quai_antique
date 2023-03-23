import React, {useEffect} from 'react';

export default function (props){

    useEffect(()=>{
        let Logo=document.getElementById('Logo').getContext("2d");
        let pathLogo1=new Path2D("M0 35.2518H72L60.6393 50H14.1639L0 35.2518Z");
        let pathLogo2=new Path2D("M33.7797 0L63.0396 34.1727H33.7797V0Z");
        let pathLogo3=new Path2D("M32.5903 9.59229V34.0527H11.9888L32.5903 9.59229Z");
        let pathLogo4=new Path2D(
            "M50.4052 39.3411C47.529 38.7555 45.1437 37.1859 43.2492 34.6322C41.3548 32.0785 40.4787 28.8091 40.6211 24.824C40.764 20.8226 42.0361 17.3337 44.4374 14.357C46.8549 11.3804 50.1148 9.88399 54.2169 9.86773C58.351 9.86773 61.6226 11.234 64.0314 13.9667C66.4403 16.6993 67.5753 20.2371 67.4365 24.58L67.4347 24.6288C67.2912 28.6464 66.2327 31.8508 64.2593 34.2418C62.2864 36.6166 60.2871 38.1374 58.2613 38.8043C64.1411 41.8785 69.4323 44.1151 74.1349 45.5139C78.8532 46.929 82.5959 47.6366 85.3628 47.6366C88.1297 47.6366 90.1532 47.4902 91.4332 47.1974C92.7132 46.9046 93.8801 46.5875 94.934 46.2459L94.8921 47.417C94.1644 48.1978 92.7992 48.824 90.7967 49.2957C88.7942 49.7674 86.4742 50.0114 83.8369 50.0276C76.0244 50.0276 64.8805 46.4655 50.4052 39.3411ZM44.305 24.214C44.1365 28.9311 44.9899 32.3794 46.8651 34.559C48.7404 36.7386 51.0612 37.8365 53.8275 37.8528C57.0665 37.8528 59.4858 36.6491 61.0854 34.2418C62.702 31.8182 63.5835 28.7847 63.7299 25.1412C63.8932 20.5705 62.9974 17.171 61.0425 14.9426C59.1039 12.7142 56.7025 11.5919 53.8385 11.5756H53.8141C51.0797 11.5756 48.8406 12.7467 47.0968 15.089C45.3693 17.4313 44.4386 20.4729 44.305 24.214ZM70.6643 20.3347L70.6992 19.3587H76.29L75.9256 29.5573C75.9175 29.785 75.8652 30.5658 75.7687 31.8996C75.5031 35.6895 76.7614 37.6007 79.5434 37.6332C81.0896 37.6332 82.4545 37.0151 83.638 35.7789C84.8214 34.5427 85.4411 33.1439 85.4969 31.5824L85.7087 25.6536C85.786 23.4902 85.7374 22.1158 85.563 21.5302C85.3305 20.7495 84.4167 20.3591 82.8216 20.3591L82.8574 19.3587H88.9609L88.4492 33.6807C88.3859 35.4536 88.7143 36.5109 89.4346 36.8525C89.7711 36.9988 90.4204 37.0476 91.3825 36.9988L91.474 37.8528L86.0864 39.6827L85.3225 36.4621L84.489 37.2428C82.526 38.8857 80.4944 39.7152 78.3942 39.7315C75.79 39.7315 74.1084 38.7393 73.3492 36.7549C72.9027 35.5837 72.7155 33.9897 72.7876 31.9728L73.0604 24.336C73.1319 22.3354 72.7622 21.0666 71.9513 20.5299C71.5851 20.3021 71.1561 20.2371 70.6643 20.3347ZM112.797 36.9013C112.762 36.9826 112.633 37.1778 112.41 37.4868C112.204 37.7959 111.932 38.1212 111.594 38.4628C111.272 38.8043 110.904 39.1053 110.487 39.3655C110.071 39.642 109.642 39.7803 109.203 39.7803C108.568 39.7803 108.061 39.6339 107.681 39.3411C107.3 39.0483 107.004 38.6823 106.792 38.2432C106.58 37.804 106.434 37.3404 106.354 36.8525C106.274 36.3482 106.225 35.9009 106.206 35.5105C106.089 35.6081 105.867 35.8847 105.542 36.3401C105.216 36.7955 104.784 37.2835 104.244 37.804C103.705 38.3082 103.046 38.7637 102.267 39.1703C101.504 39.577 100.626 39.7803 99.6327 39.7803C99.1444 39.7803 98.6341 39.7152 98.1016 39.5851C97.5854 39.455 97.1213 39.2354 96.7091 38.9263C96.2976 38.601 95.963 38.17 95.7055 37.6332C95.4486 37.0802 95.3346 36.397 95.3637 35.5837C95.4049 34.4289 95.8217 33.4692 96.614 32.7047C97.4063 31.9402 98.3799 31.3384 99.5349 30.8992C100.69 30.4601 101.743 30.1429 102.694 29.9477C103.662 29.7362 104.81 29.5004 106.137 29.2401L106.283 25.1656C106.296 24.8077 106.295 24.3604 106.282 23.8237C106.285 23.2706 106.207 22.742 106.046 22.2378C105.901 21.7173 105.64 21.2781 105.263 20.9202C104.902 20.5461 104.363 20.3591 103.647 20.3591C102.768 20.3591 102.038 20.5299 101.456 20.8714C100.89 21.213 100.472 21.5221 100.202 21.7986C99.9316 22.0751 99.559 22.4817 99.0841 23.0185C98.5283 23.0836 98.0892 23.0754 97.7666 22.9941C97.4608 22.8965 97.2053 22.7583 97.0001 22.5793C96.8118 22.3842 96.7234 22.1239 96.7351 21.7986C96.7519 21.3269 97.126 20.8796 97.8572 20.4567C98.5885 20.0338 99.5296 19.6597 100.681 19.3343C101.848 18.9928 102.945 18.822 103.97 18.822C104.898 18.822 105.674 18.9602 106.299 19.2367C106.925 19.497 107.432 19.863 107.823 20.3347C108.213 20.7901 108.503 21.3269 108.693 21.945C108.883 22.5468 109.006 23.1893 109.063 23.8725C109.137 24.5556 109.16 25.255 109.135 25.9707C109.126 26.6864 109.109 27.3777 109.085 28.0446C109.041 29.2808 108.982 30.4845 108.907 31.6556C108.833 32.8267 108.804 33.8758 108.819 34.803C108.836 35.7139 108.931 36.4539 109.106 37.0232C109.298 37.5763 109.63 37.8528 110.102 37.8528C110.704 37.8528 111.334 37.2998 111.992 36.1937L112.797 36.9013ZM106.08 30.8504C104.754 31.0456 103.615 31.2652 102.663 31.5092C101.726 31.7532 100.975 32.0622 100.408 32.4363C99.8573 32.8104 99.4271 33.2333 99.1173 33.7051C98.8244 34.1605 98.666 34.7217 98.6421 35.3885C98.584 37.0151 99.2711 37.8284 100.703 37.8284C101.224 37.8284 101.768 37.6413 102.335 37.2672C102.902 36.8931 103.43 36.4458 103.921 35.9253C104.412 35.3885 104.847 34.8355 105.225 34.2662C105.604 33.6969 105.865 33.2252 106.008 32.8511L106.08 30.8504ZM121.688 19.0172L121.157 33.8758C121.104 35.3723 121.175 36.3482 121.37 36.8037C121.566 37.2428 122.051 37.5437 122.827 37.7064L124.258 37.9748L124.222 38.9751H114.969L115.006 37.9504L116.703 37.5844C117.31 37.4543 117.691 37.2672 117.846 37.0232C117.987 36.7467 118.073 36.153 118.105 35.2422L118.498 24.2628C118.538 23.1405 118.513 22.4573 118.424 22.2134C118.217 21.6441 117.316 21.3594 115.72 21.3594L115.628 20.5299L121.688 19.0172ZM117.854 9.47735C117.874 8.90805 118.079 8.42822 118.467 8.03784C118.872 7.6312 119.359 7.42788 119.929 7.42788C120.483 7.42788 120.947 7.6312 121.323 8.03784C121.716 8.42822 121.903 8.90805 121.882 9.47735C121.863 10.0304 121.642 10.5021 121.221 10.8925C120.817 11.2666 120.339 11.4536 119.785 11.4536C119.216 11.4536 118.742 11.2666 118.365 10.8925C118.005 10.5021 117.834 10.0304 117.854 9.47735ZM143.803 9.55055C145.805 9.55055 147.34 9.88399 148.406 10.5509C149.886 11.5106 151.034 13.3079 151.851 15.943C154.797 25.5234 156.668 31.4685 157.464 33.7782C158.29 36.1856 159.357 37.5194 160.666 37.7796L161.758 37.9748L161.722 38.9751H151.663L151.7 37.9504L153.595 37.5356C154.367 37.3404 154.772 36.9175 154.812 36.2669C154.826 35.8765 154.731 35.3479 154.527 34.681L152.914 29.2645H143.026C141.486 33.64 140.695 35.966 140.653 36.2425C140.627 36.9582 141.179 37.4462 142.309 37.7064L143.74 37.9748L143.704 38.9751H134.5L134.537 37.9504L135.913 37.7064C137.125 37.4787 138.225 36.0717 139.213 33.4855L145.033 18.1876C146.094 15.3737 146.659 13.682 146.728 13.1127C146.813 12.5434 146.636 12.2588 146.197 12.2588C145.676 12.2588 145.177 12.3482 144.698 12.5272C144.236 12.7061 143.94 12.7955 143.81 12.7955C143.028 12.7955 142.512 12.4377 142.261 11.722C142.188 11.478 142.157 11.2259 142.166 10.9657C142.312 10.071 142.858 9.59934 143.803 9.55055ZM148.568 14.2351L143.593 27.7518H152.504L148.568 14.2351ZM175.642 21.091C173.315 21.091 171.25 21.7091 169.448 22.9453L169.058 33.8758C169.004 35.3723 169.075 36.3482 169.27 36.8037C169.466 37.2428 169.952 37.5437 170.727 37.7064L172.158 37.9748L172.122 38.9751H162.87L162.906 37.9504L164.604 37.5844C165.211 37.4543 165.592 37.2672 165.747 37.0232C165.887 36.7467 165.973 36.153 166.006 35.2422L166.398 24.2628C166.44 23.0917 166.361 22.3516 166.16 22.0426C165.785 21.6034 164.939 21.3757 163.621 21.3594L163.528 20.5299L169.588 19.0172L169.512 21.1642C172.333 19.6515 174.728 18.8952 176.697 18.8952C179.171 18.8952 180.8 20.0012 181.584 22.2134C181.968 23.2869 182.133 24.5963 182.078 26.1415L181.8 33.9246C181.746 35.4211 181.817 36.397 182.013 36.8525C182.225 37.2916 182.703 37.5844 183.446 37.7308L184.876 38.0236L184.842 38.9751H175.614L175.649 37.9748L177.322 37.6332C177.945 37.5031 178.326 37.3079 178.466 37.0476C178.606 36.7711 178.692 36.1774 178.725 35.2666L179.023 26.9223C179.128 23.0673 178.001 21.1236 175.642 21.091ZM198.244 21.2374H193.166L192.819 30.948C192.769 32.3469 192.739 33.6644 192.727 34.9006C192.716 36.1205 192.873 36.9582 193.199 37.4136C193.541 37.8528 194.046 38.0724 194.713 38.0724C195.901 38.0724 197.183 37.7471 198.557 37.0964L198.51 38.414C196.752 39.3248 195.263 39.7803 194.042 39.7803C192.886 39.7803 191.998 39.5851 191.377 39.1947C190.772 38.8206 190.334 38.3326 190.062 37.7308C189.808 37.1127 189.67 36.4214 189.648 35.6569C189.627 34.8924 189.63 34.128 189.657 33.3635L190.031 22.8965C190.044 22.5387 190.045 22.2622 190.036 22.067C190.043 21.8718 190.017 21.701 189.957 21.5546C189.913 21.4082 189.786 21.3188 189.576 21.2862C189.365 21.2537 189.048 21.2374 188.625 21.2374H187.258L187.299 20.0907C188.885 19.4238 189.983 18.7813 190.591 18.1632C191.199 17.5451 191.864 16.4716 192.585 14.9426H193.391L193.232 19.4075H198.31L198.244 21.2374ZM207.821 19.0172L207.29 33.8758C207.237 35.3723 207.307 36.3482 207.503 36.8037C207.699 37.2428 208.184 37.5437 208.96 37.7064L210.391 37.9748L210.355 38.9751H201.102L201.139 37.9504L202.836 37.5844C203.443 37.4543 203.824 37.2672 203.979 37.0232C204.119 36.7467 204.206 36.153 204.238 35.2422L204.63 24.2628C204.671 23.1405 204.646 22.4573 204.557 22.2134C204.35 21.6441 203.448 21.3594 201.853 21.3594L201.761 20.5299L207.821 19.0172ZM203.987 9.47735C204.007 8.90805 204.211 8.42822 204.6 8.03784C205.005 7.6312 205.492 7.42788 206.062 7.42788C206.615 7.42788 207.08 7.6312 207.456 8.03784C207.849 8.42822 208.035 8.90805 208.015 9.47735C207.995 10.0304 207.775 10.5021 207.354 10.8925C206.95 11.2666 206.472 11.4536 205.918 11.4536C205.348 11.4536 204.875 11.2666 204.498 10.8925C204.137 10.5021 203.967 10.0304 203.987 9.47735ZM225.454 18.8464C227.602 18.8464 229.336 19.3018 230.654 20.2127H232.217L231.149 50.1008C231.096 51.581 231.159 52.5407 231.339 52.9799C231.518 53.4353 232.003 53.7525 232.794 53.9314L233.739 54.1266L233.701 55.2001H224.082L224.12 54.1266C225.986 53.8501 227.094 53.5817 227.445 53.3214C227.829 53.0449 228.038 52.4268 228.073 51.4672L228.54 38.3896C228.441 38.4221 228.235 38.4953 227.922 38.6091C225.974 39.3574 224.293 39.7315 222.877 39.7315C219.215 39.7315 216.582 38.2594 214.978 35.3154C214.08 33.5587 213.648 31.7694 213.68 29.9477C213.799 26.6132 214.864 23.9294 216.873 21.8962C218.883 19.863 221.743 18.8464 225.454 18.8464ZM228.613 36.3401L228.99 25.7755C229.097 22.7827 228.092 21.0748 225.975 20.6519C225.571 20.5705 225.141 20.5299 224.686 20.5299C222.667 20.5299 220.899 21.2944 219.379 22.8233C217.876 24.3523 217.075 26.4994 216.976 29.2645C216.877 32.0297 217.55 34.1524 218.995 35.6325C220.44 37.0964 222.049 37.8284 223.824 37.8284C225.061 37.8284 226.027 37.6657 226.722 37.3404C227.417 37.0151 228.047 36.6817 228.613 36.3401ZM236.973 20.3347L237.008 19.3587H242.599L242.234 29.5573C242.226 29.785 242.174 30.5658 242.077 31.8996C241.812 35.6895 243.07 37.6007 245.852 37.6332C247.398 37.6332 248.763 37.0151 249.947 35.7789C251.13 34.5427 251.75 33.1439 251.806 31.5824L252.017 25.6536C252.095 23.4902 252.046 22.1158 251.872 21.5302C251.639 20.7495 250.725 20.3591 249.13 20.3591L249.166 19.3587H255.27L254.758 33.6807C254.695 35.4536 255.023 36.5109 255.743 36.8525C256.08 36.9988 256.729 37.0476 257.691 36.9988L257.783 37.8528L252.395 39.6827L251.631 36.4621L250.798 37.2428C248.835 38.8857 246.803 39.7152 244.703 39.7315C242.099 39.7315 240.417 38.7393 239.658 36.7549C239.211 35.5837 239.024 33.9897 239.096 31.9728L239.369 24.336C239.441 22.3354 239.071 21.0666 238.26 20.5299C237.894 20.3021 237.465 20.2371 236.973 20.3347ZM270.352 18.822C273.477 18.822 275.395 20.0419 276.105 22.4817C276.424 23.5878 276.483 24.6695 276.282 25.7267H264.588C264.335 26.8979 264.19 27.9877 264.154 28.9961C264.031 32.4282 264.973 34.7705 266.979 36.0229C268.046 36.6898 269.344 37.0232 270.874 37.0232C272.469 37.0232 274.093 36.4377 275.746 35.2666L276.428 35.9985L275.716 36.8037C273.791 38.7393 271.559 39.7152 269.019 39.7315C267.506 39.7315 266.122 39.276 264.869 38.3652C262.347 36.5271 261.152 33.7457 261.285 30.0209C261.426 26.0846 262.631 23.0998 264.901 21.0666C266.613 19.619 268.43 18.8708 270.352 18.822ZM264.889 24.1408H273.19C273.235 22.8559 272.976 21.9043 272.413 21.2862C271.849 20.6519 271.112 20.3347 270.201 20.3347C268.784 20.3347 267.614 20.7576 266.688 21.6034C265.764 22.4329 265.164 23.2788 264.889 24.1408Z"
        );
        Logo.fillStyle="#75E6DA";
        Logo.fill(pathLogo1);
        Logo.fill(pathLogo2);
        Logo.fill(pathLogo3);
        Logo.fillStyle="#189AB4";
        Logo.fill(pathLogo4);
    });

    return (
        <canvas id="Logo" width="278" height="56" className={props.class}></canvas>
    );
}
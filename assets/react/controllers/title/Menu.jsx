import React, {useEffect} from "react";

export default function (){

    useEffect(()=>{
        let Menu=document.getElementById('Menu').getContext("2d");
        let pathMenu1=new Path2D("M0 35.2517H72L60.6393 49.9999H14.1639L0 35.2517Z");
        let pathMenu2=new Path2D("M33.7797 0L63.0396 34.1727H33.7797V0Z");
        let pathMenu3=new Path2D("M32.5903 9.59229V34.0527H11.9888L32.5903 9.59229Z");
        let pathMenu4=new Path2D(
            "M39.1305 15.6488C39.1712 14.5102 40.0134 13.9409 41.6573 13.9409H48.8595L48.8333 13.9897H49.4925L51.0977 15.5268L57.736 37.4611L68.2687 13.9409H75.2999L75.2598 15.0633C74.0304 15.3072 73.2369 15.6488 72.8795 16.088C72.522 16.5272 72.3313 17.0802 72.3075 17.7471L71.5396 39.2422C71.5012 40.3157 71.5678 40.9582 71.7393 41.1696C71.9276 41.3648 72.2723 41.5112 72.7734 41.6088L74.4214 41.9504L74.3847 42.9751H64.8877L64.9234 41.9748L66.349 41.7064C67.2175 41.5437 67.7421 41.2103 67.9228 40.7061C68.1199 40.2018 68.2428 39.2666 68.2916 37.9002L69.0308 17.2103L57.3429 43.6827H56.464L48.3503 17.9423L44.3728 37.0219L43.8113 39.7545C43.6898 40.8769 44.0735 41.5275 44.9623 41.7064L48.0045 41.9748L47.9687 42.9751H38.5449L38.5806 41.9748L39.4927 41.7308C40.2152 41.5519 40.7052 41.2754 40.9627 40.9013C41.2208 40.5109 41.4356 39.966 41.6071 39.2666C42.8143 34.1754 43.8597 29.5153 44.7432 25.2862L46.1914 18.2351C46.3379 17.3242 46.4056 16.7955 46.3946 16.6492C46.3184 16.0473 46.0118 15.7464 45.4747 15.7464C44.9544 15.7301 44.3673 15.9904 43.7134 16.5272C42.8589 17.2103 42.0247 17.5519 41.2109 17.5519C40.3971 17.5519 39.8432 17.3404 39.549 16.9175C39.2555 16.4784 39.116 16.0555 39.1305 15.6488ZM86.7502 22.822C89.8752 22.822 91.7929 24.0419 92.5033 26.4817C92.8218 27.5878 92.8808 28.6695 92.6803 29.7267H80.986C80.7325 30.8979 80.5878 31.9877 80.5518 32.9961C80.4292 36.4282 81.3709 38.7705 83.3769 40.0229C84.4436 40.6898 85.7419 41.0232 87.2719 41.0232C88.8669 41.0232 90.491 40.4377 92.1442 39.2666L92.8261 39.9985L92.1137 40.8037C90.1891 42.7393 87.9569 43.7152 85.4173 43.7315C83.9036 43.7315 82.5202 43.276 81.2669 42.3652C78.7447 40.5271 77.5501 37.7457 77.6832 34.0209C77.8238 30.0846 79.029 27.0998 81.2989 25.0666C83.0108 23.619 84.8279 22.8708 86.7502 22.822ZM81.2868 28.1408H89.5876C89.6335 26.8559 89.3745 25.9043 88.8106 25.2862C88.2474 24.6519 87.51 24.3347 86.5985 24.3347C85.1825 24.3347 84.0118 24.7576 83.0864 25.6034C82.1616 26.4329 81.5617 27.2788 81.2868 28.1408ZM108.886 25.091C106.558 25.091 104.494 25.7091 102.692 26.9453L102.301 37.8758C102.248 39.3723 102.319 40.3482 102.514 40.8037C102.71 41.2428 103.196 41.5437 103.971 41.7064L105.402 41.9748L105.366 42.9751H96.1133L96.1499 41.9504L97.8475 41.5844C98.4544 41.4543 98.8354 41.2672 98.9906 41.0232C99.1307 40.7467 99.217 40.153 99.2496 39.2422L99.6418 28.2628C99.6836 27.0917 99.6043 26.3516 99.4037 26.0426C99.0288 25.6034 98.1824 25.3757 96.8647 25.3594L96.7722 24.5299L102.832 23.0172L102.755 25.1642C105.576 23.6515 107.972 22.8952 109.941 22.8952C112.415 22.8952 114.044 24.0012 114.827 26.2134C115.212 27.2869 115.377 28.5963 115.322 30.1415L115.044 37.9246C114.99 39.4211 115.061 40.397 115.256 40.8525C115.469 41.2916 115.946 41.5844 116.69 41.7308L118.12 42.0236L118.086 42.9751H108.857L108.893 41.9748L110.566 41.6332C111.189 41.5031 111.57 41.3079 111.709 41.0476C111.85 40.7711 111.936 40.1774 111.968 39.2666L112.267 30.9223C112.372 27.0673 111.245 25.1236 108.886 25.091ZM120.461 24.3347L120.496 23.3587H126.087L125.722 33.5573C125.714 33.785 125.662 34.5658 125.565 35.8996C125.3 39.6895 126.558 41.6007 129.34 41.6332C130.886 41.6332 132.251 41.0151 133.434 39.7789C134.618 38.5427 135.238 37.1439 135.293 35.5824L135.505 29.6536C135.582 27.4902 135.534 26.1158 135.36 25.5302C135.127 24.7495 134.213 24.3591 132.618 24.3591L132.654 23.3587H138.757L138.246 37.6807C138.182 39.4536 138.511 40.5109 139.231 40.8525C139.568 40.9988 140.217 41.0476 141.179 40.9988L141.271 41.8528L135.883 43.6827L135.119 40.4621L134.286 41.2428C132.323 42.8857 130.291 43.7152 128.191 43.7315C125.587 43.7315 123.905 42.7393 123.146 40.7549C122.699 39.5837 122.512 37.9897 122.584 35.9728L122.857 28.336C122.928 26.3354 122.559 25.0666 121.748 24.5299C121.382 24.3021 120.953 24.2371 120.461 24.3347Z"
        );
        Menu.fillStyle="#05445E";
        Menu.fill(pathMenu1);
        Menu.fill(pathMenu2);
        Menu.fill(pathMenu3);
        Menu.fillStyle="#75E6DA";
        Menu.fill(pathMenu4);
    });

    return (
        <canvas id="Menu" className="hor-center" width="143" height="50"></canvas>
    );
}
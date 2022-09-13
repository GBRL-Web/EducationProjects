import React from 'react';

export default function Carousel() {
    return (
        <div>
            <div
                id="default-carousel"
                className="relative w-full bg-black z-10"
                data-carousel="static"
            >
                <div className="overflow-hidden relative h-[600px] rounded-lg sm:h-[400px] xl:h-[600px] 2xl:h-[800px]">
                    <div
                        className="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-0"
                        data-carousel-item=""
                    >
                        <span className="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl dark:text-gray-800">
                            First Slide
                        </span>
                        <img
                            src="/src/app/assets/images/Carousel/Photos_carousel1.png"
                            className="block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                            alt="..."
                        />
                    </div>

                    <div
                        className="duration-700 ease-in-out absolute inset-0 transition-all transform translate-x-full"
                        data-carousel-item=""
                    >
                        <img
                            src="/src/app/assets/images/Carousel/photo3_carousel.png"
                            className="block absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2"
                            alt="..."
                        />
                    </div>

                    <div
                        className="duration-700 ease-in-out absolute inset-0 transition-all transform -translate-x-full"
                        data-carousel-item=""
                    >
                        <img
                            src="/src/app/assets/images/Carousel/photo2_carousel.png"
                            className="block absolute top-1/2 left-1/2  -translate-x-1/2 -translate-y-1/2"
                            alt="..."
                        />
                    </div>
                </div>

                <div className="flex absolute bottom-5 left-1/2 space-x-3 -translate-x-1/2">
                    <button
                        type="button"
                        className="w-3 h-3 rounded-full bg-white dark:bg-gray-800"
                        aria-current="true"
                        aria-label="Slide 1"
                        data-carousel-slide-to="0"
                    ></button>
                    <button
                        type="button"
                        className="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                        aria-current="false"
                        aria-label="Slide 2"
                        data-carousel-slide-to="1"
                    ></button>
                    <button
                        type="button"
                        className="w-3 h-3 rounded-full bg-white/50 dark:bg-gray-800/50 hover:bg-white dark:hover:bg-gray-800"
                        aria-current="false"
                        aria-label="Slide 3"
                        data-carousel-slide-to="2"
                    ></button>
                </div>

                <button
                    type="button"
                    className="flex absolute top-0 left-0 justify-center items-center px-4 z-20 h-full cursor-pointer group focus:outline-none hover:opacity-80 "
                    data-carousel-prev=""
                >
                    <img src="/src/app/assets/images/Carousel/Prev.png" alt="..." />
                </button>
                <button
                    type="button"
                    className="flex absolute top-0 right-0 justify-center items-center z-20 px-4 h-full cursor-pointer group focus:outline-none hover:opacity-80"
                    data-carousel-next=""
                >
                    <img src="/src/app/assets/images/Carousel/Next.png" alt="..." />
                </button>
            </div>
        </div>
    );
}

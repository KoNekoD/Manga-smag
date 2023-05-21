import Carousel from 'stimulus-carousel'

export default class extends Carousel {
    connect() {
        super.connect()
        // console.log('Do what you want here.')

        // The swiper instance.
        // this.swiper

        // Default options for every carousels.
        // this.defaultOptions
    }

    // You can set default options in this getter.
    get defaultOptions() {
        return {
            // https://swiperjs.com/swiper-api

            centerSlides: true,
            loop: true,
            autoplay: {
                delay: 3000
            },
            // Default parameters
            slidesPerView: 1,
            spaceBetween: 10,
            // Responsive breakpoints
            breakpoints: {
                // when window width is >= 320px
                320: {
                    slidesPerView: 2,
                    spaceBetween: 20
                },
                // when window width is >= 480px
                480: {
                    slidesPerView: 3,
                    spaceBetween: 30
                },
                // when window width is >= 640px
                640: {
                    slidesPerView: 6,
                    spaceBetween: 20
                }
            },
            setWrapperSize: true,
        }
    }
}

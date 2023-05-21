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
            ...super.defaultOptions,
            'slidesPerView': 5,
            centerSlides: true,
            loop: true,
            autoplay: {
                delay: 3000
            }
        }
    }
}

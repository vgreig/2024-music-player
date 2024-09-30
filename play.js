import {
    Carousel,
    initTWE
} from "tw-elements";

initTWE({Carousel});

const togglePlay = () => {
    if (playing) {
        pause()
    } else {
        play()
    }
}
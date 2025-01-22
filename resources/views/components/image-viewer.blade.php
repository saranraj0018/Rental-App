<template x-teleport="body">
    <div x-show="open" @keydown.escape.window="open = false" @click.away="open = false">
        <div>
            <div class="fullscreen-modal" x-transition>
                <button @click="open = false" class="close-button">✕</button>
                <img :src="src" alt="Full View" class="image-view" />
            </div>
        </div>

        <style>
            .fullscreen-modal {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background-color: rgba(0, 0, 0, 0.9);
                display: flex;
                justify-content: center;
                align-items: center;
                z-index: 50;
                opacity: 1;
                transition: opacity 0.3s ease;

            }

            .close-button {
                position: absolute;
                top: 20px;
                right: 20px;
                font-size: 24px;
                color: white;
                background: none;
                border: none;
                cursor: pointer;
            }

            .image-view {
                max-width: 90%;
                max-height: 90%;
                object-fit: contain;
            }
        </style>

    </div>
</template>

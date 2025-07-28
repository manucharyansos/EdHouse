<script setup lang="ts">
import type { HTMLAttributes } from 'vue';

defineOptions({
    inheritAttrs: false,
});

interface Props {
    className?: HTMLAttributes['class'];
}

defineProps<Props>();
</script>

<template>
    <div>
        <svg baseProfile="tiny" height="30px" width="30px" version="1.2" xmlns="http://www.w3.org/2000/svg">
            <rect fill="white" height="30px" width="30px" x="0" y="0" />
            <line stroke="black" stroke-width="1" x1="10" x2="15" y1="11" y2="5" />
            <line stroke="black" stroke-width="1" x1="15" x2="20" y1="5" y2="11" />
            <line stroke="black" stroke-width="0.5" x1="8" x2="8" y1="9" y2="24" />
            <line stroke="black" stroke-width="0.5" x1="5" x2="25" y1="24" y2="24" />
            <text fill="black" font-family="Arial" font-size="4px" x="9" y="21">Ed</text>
            <text fill="black" font-family="Arial" font-size="5px" font-weight="bold" x="14" y="21">H</text>
            <text fill="black" font-family="Arial" font-size="4px" x="17" y="21">ouse</text>
            <text fill="black" font-family="Arial" font-size="2px" x="11" y="28">DESIGN</text>
        </svg>

    </div>

</template>

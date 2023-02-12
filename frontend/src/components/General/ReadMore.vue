<template>
    <div class="block-content">
      <transition
        @before-enter="onBeforeEnter"
        @enter="onEnter"
        @after-enter="onAfterEnter"
        @before-leave="onBeforeLeave"
        @leave="onLeave"
        mode="out-in"
      >
        <div v-if="!isExpanded" class="block-content__preview">
          <p ref="preview" v-html="content" />
        </div>
        <p
          v-else
          :class="{
            'block-content__paragraph text-xs': true,
            'block-content__paragraph--is-expanded text-xs': isExpanded,
          }"
          v-html="content"
        />
      </transition>
      <button
        v-if="isToggleButtonRequired"
        type="button"
        class="block-content__button text-xs"
        aria-label="Toggle button"
        @click="isExpanded = !isExpanded"
      >
        {{ toggleCtaLabel }}
      </button>
    </div>
  </template>
  
  <script >
  import { computed, defineComponent, onMounted, ref, toRefs } from "vue";
  export default defineComponent({
    name: "ReadMore",
    props: {
      content: { type: String },
      visibleLines: { type: Number, default: 4 },
    },
    setup(props) {
      const { visibleLines } = toRefs(props);
      // Collapsed state
      // Assuming that default line-height is 24px
      const LINE_HEIGHT = 24;
      const maxHeightCollapsed = computed(() => LINE_HEIGHT * visibleLines.value);
      // Expanded state
      const isExpanded = ref(false);
      // Toggle button
      const preview = ref(null);
      onMounted(() => {
        const previewHeight = (preview.value ?? {}).clientHeight ?? 0;
        isToggleButtonRequired.value = previewHeight > maxHeightCollapsed.value;
      });
      const isToggleButtonRequired = ref(false);
      const toggleCtaLabel = computed(() =>
        isExpanded.value ? "Read less" : "Read more"
      );
      // Animation hooks (omitted to minimize snippet length)
      const onBeforeEnter = (el) => {
      const htmlEl = el;
      htmlEl.style.height = maxHeightCollapsed.value + "px";
    };
    const onEnter = (el) => {
      const htmlEl = el;
      htmlEl.style.height = el.scrollHeight + "px";
    };
    const onAfterEnter = (el) => {
      const htmlEl = el;
      htmlEl.style.overflow = "hidden";
    };
    const onBeforeLeave = (el) => {
      const htmlEl = el;
      htmlEl.style.height = `${el.scrollHeight}px`;
      htmlEl.style.overflow = "hidden";
    };
    const onLeave = (el) => {
      const htmlEl = el;
      htmlEl.style.height = maxHeightCollapsed.value + "px";
      htmlEl.style.overflow = "hidden";
    };
      return {
        isExpanded,
        preview,
        isToggleButtonRequired,
        toggleCtaLabel,
        onBeforeEnter,
        onEnter,
        onAfterEnter,
        onBeforeLeave,
        onLeave,
      };
    },
  });

  </script>


<style  scoped>
.block-content {
  display: flex;
  flex-direction: column;
  align-items: flex-start;
  gap: 8px;
  padding: 24px 20px;
  background-color: white;
  border-radius: 8px;
}
.block-content__preview {
  /* default line-height is 24px */
  max-height: calc(24px * v-bind(visibleLines));
  overflow: hidden;
  color: black;
}
.block-content__paragraph {
  color: black;
  overflow: hidden;
  transition: all 250ms ease-out;
}
.block-content__paragraph.block-content__paragraph--is-expanded {
  overflow: initial;
}
.block-content__button {
  color: blue;
  text-decoration: underline;
  align-self: flex-end;
}
  </style>
  
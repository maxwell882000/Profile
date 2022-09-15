<template>
  <div style="white-space: nowrap">
<!--    <b-icon-->
    <span
        v-for="(star, iconI) in starsIcons"
        :key="'icon_' + iconI"
        :class="'bi bi-' +star"
        class="star mx-1"
    />
  </div>

</template>
<script>
export default {
  props: ['rating'],
  computed: {
    starsIcons() {
      // return array of strings depending on rating
      let ratingCp = this.rating;
      const stars = [];
      for (let i = 1; i <= ratingCp; i++) {
        stars.push("star-fill");
      }
      // decimal part of ratingCp
      if (ratingCp % 1 > 0.4 && ratingCp % 1 < 0.85) {
        stars.push("star-half");
        ratingCp++;
      } else if (ratingCp % 1 > 0.85) {
        stars.push("star-fill");
        ratingCp++;
      }
      for (let i = 0; i < 5 - ratingCp; i++) {
        stars.push("star");
      }
      return stars;
    },
  }
}
</script>
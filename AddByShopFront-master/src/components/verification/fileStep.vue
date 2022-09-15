<template>
  <loader waiting="file_loaded">
    <section class="rounded-st p-3 bg-white mb-3">
      <b-row>
        <b-col cols="12" class="col-xl-6 col-lg-7 col-md-12 col-sm-12">
          <h6>{{ title }}</h6>
          <div class="mb-3">
      <span class="text-sm">
      {{ decs }}
      </span>
          </div>
          <loader :div-style="{height: 'auto'}" :waiting="waiting">
            <div
                @click="$refs.input_file.click()"
                @dragover.prevent="dragover" @dragleave="dragleave" @drop.prevent="drop"
                class="input-file  rounded-st  pointer" :class="image || 'p-3'">
              <input @change="onChange" type="file" ref="input_file" style="display: none">
              <template v-if="!image">
                <div class="h-50">
                  <img class="img-res" :src="require('@/assets/' + assetImage)">
                </div>
                <span>
              <span class="text-blue">{{ $t("Нажмите") }}  </span>
                  {{ $t("чтобы выбрать фотографии или просто перетащите их сюда") }}
            </span>
              </template>
              <template v-else>
                <div class="image-min-height">
                  <img class="img-res rounded-st" :src="image">
                </div>
              </template>
            </div>
          </loader>
        </b-col>
      </b-row>
    </section>

    <router-link :to="correctPath + back" replace>
      <ButtonGray style="background-color: var(--gray600)" :title-style="{color: 'white'}" class="mr-2 w-20 mb-3 py-2"
                  :title="$t('Назад')"></ButtonGray>
    </router-link>
    <router-link :to="isFullNextPath ? next : correctPath + next " replace>
      <ButtonBlue @click="$emit('nextPage')" class="w-20 mb-3 py-2"
                  :title="$t('Далее')"></ButtonBlue>
    </router-link>
  </loader>

</template>
<script>
import Loader from "@/components/loading/loader";
import ButtonGray from "@/components/helper/button/buttonGray";
import ButtonBlue from "@/components/helper/button/buttonBlue";
// eslint-disable-next-line no-unused-vars
let sleep = milliseconds => new Promise(resolve => setTimeout(resolve, milliseconds));
export default {
  components: {ButtonBlue, ButtonGray, Loader},
  emits: ['image-upload', 'nextPage'],
  props: ['initialImage', 'waiting',
    'title', 'decs', 'assetImage', "next", 'back', 'isFullNextPath'],
  data() {
    return {
      filelist: {},
      image: this.initialImage
    }
  },
  computed: {
    correctPath() {
      const path = this.$route.path.split("/");
      return path.slice(0, path.length - 1).join("/");
    }
  },
  methods: {
    async onChange() {
      if (this.$refs.input_file.files.length !== 0) {
        this.filelist = this.$refs.input_file.files[0];
        this.image = URL.createObjectURL(this.filelist);
        this.$emit("image-upload", this.image, this.filelist);
      }
    },

    remove(i) {
      this.filelist.splice(i, 1);
    },
    dragover() {
      // Add some visual fluff to show the user can drop its files
    },
    dragleave() {
      // Clean up
    },
    drop(event) {
      this.$refs.input_file.files = event.dataTransfer.files;
      this.onChange(); // Trigger the onChange event manually

    }
  }
}
</script>
<style scoped lang="scss">

.image-min-height {
  width: 100%;
  height: 13rem;
  //min-height: 13rem;
  //width: 100%;
}

.input-file {
  background-image: url("data:image/svg+xml,%3csvg width='100%25' height='100%25' xmlns='http://www.w3.org/2000/svg'%3e%3crect width='100%25' height='100%25' fill='none' rx='9' ry='9' stroke='%23BDBDBDFF' stroke-width='2' stroke-dasharray='13' stroke-dashoffset='57' stroke-linecap='square'/%3e%3c/svg%3e");
  border-radius: 9px;
  display: flex;
  flex-direction: column;
  text-align: center;
  align-items: center;
  justify-content: center;
}
</style>
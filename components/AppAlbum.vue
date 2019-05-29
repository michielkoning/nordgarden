<template>
  <li class="album">
    <h2>{{ album.title }}</h2>
    <div>
      {{ album.image }}
      {{ album.releaseDate | formatDate }}
      <ul class="shops">
        <li>
          <a
            v-if="album.amazon"
            rel="noopener"
            target="_blank"
            :href="album.amazon"
          >
            <app-icon
              icon="spotify"
              width="24"
              height="24"
              :title="`${'viewNordgardenOn'} spotify`"
            />
          </a>
        </li>
        <li>
          <a
            v-if="album.apple"
            rel="noopener"
            target="_blank"
            :href="album.apple"
          >
            <app-icon
              icon="apple"
              width="24"
              height="24"
              :title="`${'viewNordgardenOn'} apple`"
            />
          </a>
        </li>
      </ul>
    </div>
    <div>
      <ul class="songlist">
        <app-song
          v-for="song in album.songlist"
          :key="song.title"
          :song="song"
          class="song"
        />
      </ul>
    </div>
  </li>
</template>

<script>
import AppIcon from '@/components/AppIcon.vue'
import AppSong from '@/components/AppSong.vue'

export default {
  components: {
    AppIcon,
    AppSong
  },
  filters: {
    formatDate(value) {
      const date = new Date(value)
      return `${date.getDate()}.${date.getMonth() + 1}.${date.getFullYear()}`
    }
  },
  props: {
    album: {
      type: Object,
      required: true
    }
  }
}
</script>

<style lang="postcss" scoped>
ul {
  @mixin list-reset;
}

h2 {
  margin: 0;
  grid-column: 1 / -1;
}

.album {
  display: grid;
  grid-gap: var(--gutter);
  margin-bottom: 2em;

  @media (--viewport-sm) {
    grid-template-columns: 10em auto;
  }
}
>>> img {
  display: block;
  max-width: 10em;
  width: 100%;
  @media (--viewport-sm) {
    max-width: none;
  }
}

.songlist {
  max-width: var(--container-width-sm);
  border-top: 1px solid #ccc;
}

.shops {
  display: flex;
}

a {
  flex: 0 0 1em;
  margin-right: 0.5em;
}
</style>

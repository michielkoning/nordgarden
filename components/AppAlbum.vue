<template>
  <li class="album">
    <h2>{{ album.title }}</h2>
    <div>
      <img
        :src="`/images/albums/${album.image}.jpg`"
        alt
        :srcset="`/images/albums/${album.image}@2x.jpg 2x`"
      />
      {{ album.releaseDate | formatDate }}
      <ul class="shops">
        <li>
          <a :href="album.spotify" rel="noopener" target="_blank">
            <icon-spotify aria-hidden="true" width="32" height="32" />
            <span class="sr-only"
              >{{ $t('view') }} {{ album.title }} {{ $t('on') }} Spotify</span
            >
          </a>
        </li>
        <li>
          <a :href="album.apple" rel="noopener" target="_blank">
            <icon-apple aria-hidden="true" width="32" height="32" />
            <span class="sr-only"
              >{{ $t('view') }} {{ album.title }} {{ $t('on') }} Apple
              Music</span
            >
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
import AppSong from '@/components/AppSong.vue'
import IconApple from '@/assets/icons/apple.svg'
import IconSpotify from '@/assets/icons/spotify.svg'

export default {
  components: {
    IconSpotify,
    IconApple,
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
  @mixin link-reset;

  flex: 0 0 1em;
  margin-right: 0.5em;
}
</style>

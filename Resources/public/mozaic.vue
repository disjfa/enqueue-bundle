<template>
    <div>
        <div :class="{'Enqueue-fullscreen': fullscreen}">
            <div class="Enqueue-body">
                <div class="Enqueue-base">
                    <div v-for="piece in Enqueue">
                        <img :src="piece.shuffled.image" :style="getStyles(piece)" class="Enqueue-piece" @click="checkPiece(piece)" :class="{'active': isActivePiece(piece)}">
                    </div>
                </div>
                <div>
                    <a href="#" class="btn close" @click="toggleFullscreen()">
                        <i class="fa fa-times"></i>
                    </a>
                    <a href="#" class="btn fullscreen pull-right" @click="toggleFullscreen()">
                        <i class="fa fa-window-maximize"></i>
                        Full screen
                    </a>
                    ClickCount: <span class="tag tag-success">{{ clickCount }}</span>
                    <span class="tag tag-success" v-if="done">Success</span>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
  import Vue from 'vue';
  import axios from 'axios';

  export default {
    props: ['unsplashRoute', 'token', 'finishRoute'],
    data() {
      return {
        activePiece: false,
        done: false,
        Enqueue: {},
        shuffled: [],
        clickCount: 0,
        fullscreen: false
      }
    },
    mounted() {
      this.initData();
      this.initSize();
      let self = this;
      $(window).on('resize', function () {
        self.initSize();
      });

    },
    methods: {
      initSize() {
        let EnqueueBase = $(this.$el).find('.Enqueue-base');
        $(EnqueueBase).css({ 'height': ($(EnqueueBase).width() / 16 * 9) + 'px' });
      },
      toggleFullscreen() {
        this.fullscreen = !this.fullscreen;
        let self = this;
        setTimeout(function () {
          self.initSize();
        }, 10);
      },
      isActivePiece(piece) {
        if (false === this.activePiece) {
          return false;
        }

        return this.activePiece.x === piece.x && this.activePiece.y === piece.y;
      },
      areWeDone() {
        if (this.done) {
          return false;
        }
        for (let i in this.Enqueue) {
          if (this.Enqueue[i].x !== this.Enqueue[i].shuffled.x) {
            return false;
          }
          if (this.Enqueue[i].y !== this.Enqueue[i].shuffled.y) {
            return false;
          }
        }

        this.finished();
        this.done = true;
      },
      finished() {
        axios
          .post(this.finishRoute, {
            token: this.token,
          })
          .then(function (result) {
            // console.log(result);
          });
      },
      checkPiece(piece) {
        if (this.done) {
          return;
        }
        if (false === this.activePiece) {
          Vue.set(this, 'activePiece', piece);
          return;
        }

        let activeShuffle = this.activePiece.shuffled;
        Vue.set(this.activePiece, 'shuffled', piece.shuffled);
        piece.shuffled = activeShuffle;

        this.clickCount++;
        this.activePiece = false;
        this.areWeDone();
      },
      getStyles(col) {
        let prc = this.done ? 0 : 1;
        return {
          left: col.percent.left + '%',
          top: col.percent.top + '%',
          width: (col.percent.width - prc) + '%',
          height: (col.percent.height - prc) + '%'
        }
      },
      initData() {
        axios
          .get(this.unsplashRoute)
          .then((result) => {
            this.setupEnqueue(result.data);
          });
      },
      shuffle(a) {
        let array = [];
        let i;
        for (i in a) {
          array.push(a[i]);
        }
        let copy = [], n = array.length;

        while (n) {
          let i = Math.floor(Math.random() * array.length);

          if (i in array) {
            copy.push(array[i]);
            delete array[i];
            n--;
          }
        }

        Vue.set(this, 'shuffled', copy);
      },
      setupEnqueue(data) {
        this.shuffle(data.Enqueue);
        for (let i in this.shuffled) {
          data.Enqueue[i]['shuffled'] = this.shuffled[i];
        }

        Vue.set(this, 'Enqueue', data.Enqueue);
      }
    }
  }
</script>
<style>
    .Enqueue-base {
        position: relative;
        width: 100%;
        height: 600px;
    }

    .Enqueue-piece {
        position: absolute;
        cursor: pointer;
        transition: .1s;
        z-index: 1000;
    }

    .Enqueue-piece.active {
        box-shadow: 0 0 20px #000;
        transform: scale(1.1);
        z-index: 1010;
    }

    .Enqueue-body .close {
        display: none;
    }

    .Enqueue-fullscreen {
        position: fixed;
        top: 0;
        left: 0;
        bottom: 0;
        right: 0;
        overflow: auto;
        background: rgba(255, 255, 255, .8);
        z-index: 1050;
    }

    .Enqueue-fullscreen .Enqueue-body {
        max-width: 1200px;
        margin-left: auto;
        margin-right: auto;
        padding: 10px 20px;
    }

    .Enqueue-fullscreen .Enqueue-body .close {
        display: inline-block;
    }

    .Enqueue-fullscreen .Enqueue-body .fullscreen {
        display: none;
    }
</style>
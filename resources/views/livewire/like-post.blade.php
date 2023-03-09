<div>
    <div class="flex gap-2 items-center">

        <button wire:click="like" x-data="{
            state: '{{$isLiked ? 'Liked' : 'Unliked'}}',
            usedKeyboard: true,
            async updateState(to) {
                this.state = 'Saving'
                this.state = to
            }
          }"
          :class="{
            'like unliked': state === 'Unliked',
            'like saving': state === 'Saving',
            'like liked': state === 'Liked',
            'focus:outline-none': !usedKeyboard
          }
          "
          @click= "updateState(state === 'Unliked' ? 'Liked' : 'Unliked')" @keydown.window.tab="usedKeyboard = true">
            <span class="like-icon like-icon-state" aria-label="state" x-text="state" aria-live="polite">Unliked</span>
          </button>



        {{-- {{$isLiked}} --}}

        <p class="font-bold">{{ $likes }}
            <span class="font-normal">Likes</span>
        </p>
    </div>
</div>

<div class="progress">
  <div class="progress-bar @if($campaign->getProgress() < 100) bg-warning @else bg-success @endif" role="progressbar" style="width: {{ $campaign->getProgress() }}%" aria-valuenow="{{ $campaign->getProgress() }}" aria-valuemin="0" aria-valuemax="100">
	{{ $campaign->getProgress() }}%
</div>
</div>
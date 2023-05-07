<?php

namespace App\Http\Requests\Photo;

use App\Contracts\Http\Requests\HasAlbumID;
use App\Contracts\Http\Requests\RequestAttribute;
use App\Contracts\Models\AbstractAlbum;
use App\Http\Requests\BaseApiRequest;
use App\Http\Requests\Traits\HasAlbumIDTrait;
use App\Http\RuleSets\Photo\GetRandomPhotoRuleSet;
use App\Models\Photo;
use App\Policies\AlbumPolicy;
use Illuminate\Support\Facades\Gate;

class GetRandomPhotoRequest extends BaseApiRequest implements HasAlbumID
{
	use HasAlbumIDTrait;

	/**
	 * {@inheritDoc}
	 */
	public function authorize(): bool
	{
	return true;
//		return Gate::check(AlbumPolicy::CAN_ACCESS, [AbstractAlbum::class, $this->album]);
	}

	/**
	 * {@inheritDoc}
	 */
	public function rules(): array
	{
		return GetRandomPhotoRuleSet::rules();
	}

	/**
	 * {@inheritDoc}
	 */
	protected function processValidatedValues(array $values, array $files): void
	{
		$this->albumID = $values[RequestAttribute::ALBUM_ID_ATTRIBUTE] ?? null;
	}
}

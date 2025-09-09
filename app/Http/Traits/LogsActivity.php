<?php

namespace App\Http\Traits;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

trait LogsActivity
{
    protected function logActivity(string $action, string $description, $model = null, array $oldValues = null, array $newValues = null): void
    {
        if (!Auth::check()) {
            return;
        }

        $modelName = null;
        $modelId = null;

        if ($model) {
            $modelName = get_class($model);
            $modelId = $model->id ?? null;
        }

        ActivityLog::create([
            'user_id' => Auth::id(),
            'action' => $action,
            'model' => $modelName,
            'model_id' => $modelId,
            'description' => $description,
            'old_values' => $oldValues,
            'new_values' => $newValues,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
        ]);
    }

    protected function logCreate($model, string $description = null): void
    {
        $description = $description ?? "Menambahkan " . class_basename($model) . " baru";
        $this->logActivity('CREATE', $description, $model, null, $model->toArray());
    }

    protected function logUpdate($model, array $oldValues, string $description = null): void
    {
        $description = $description ?? "Mengubah " . class_basename($model);
        $this->logActivity('UPDATE', $description, $model, $oldValues, $model->toArray());
    }

    protected function logDelete($model, string $description = null): void
    {
        $description = $description ?? "Menghapus " . class_basename($model);
        $this->logActivity('DELETE', $description, $model, $model->toArray(), null);
    }
}

@extends('layouts.admin')

@section('title', 'Edit Test Questions')

@section('content')
<div style="padding: 40px 20px; max-width: 1200px; margin: 0 auto;">
    <!-- Page Header -->
    <div style="margin-bottom: 32px; text-align: center;">
        <h1 style="font-size: 2.2rem; font-weight: 700; color: #1e293b; margin-bottom: 12px;">
            📝 Edit Test Questions
        </h1>
        <p style="color: #64748b; font-size: 1.1rem;">Manage personality test questions (MBTI)</p>
    </div>

    <!-- Control Buttons -->
    <div style="background: white; border-radius: 20px; padding: 24px; margin-bottom: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
        <button 
            onclick="toggleEditMode()" 
            id="editBtn"
            style="padding: 14px 32px; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; border: none; border-radius: 12px; font-size: 1.05rem; font-weight: 600; cursor: pointer; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3); transition: all 0.3s; display: flex; align-items: center; gap: 8px;"
        >
            <span>✏️</span> Edit Questions
        </button>

        <button 
            onclick="addNewQuestion()" 
            id="addBtn"
            style="padding: 14px 32px; background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 12px; font-size: 1.05rem; font-weight: 600; cursor: pointer; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3); transition: all 0.3s; display: flex; align-items: center; gap: 8px;"
        >
            <span>➕</span> Add Question
        </button>

        <button 
            onclick="saveChanges()" 
            id="saveBtn"
            disabled
            style="padding: 14px 32px; background: #e2e8f0; color: #94a3b8; border: none; border-radius: 12px; font-size: 1.05rem; font-weight: 600; cursor: not-allowed; transition: all 0.3s; display: flex; align-items: center; gap: 8px;"
        >
            <span>💾</span> Save Changes
        </button>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div style="background: #d1fae5; border: 2px solid #10b981; color: #065f46; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; font-size: 1rem; font-weight: 500;">
        ✅ {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div style="background: #fee2e2; border: 2px solid #ef4444; color: #991b1b; padding: 16px 20px; border-radius: 12px; margin-bottom: 24px; font-size: 1rem; font-weight: 500;">
        ❌ {{ session('error') }}
    </div>
    @endif

    <!-- Questions Container -->
    <div id="questionsContainer">
        @foreach($questions as $index => $question)
        <div class="question-card" data-id="{{ $question->id }}" style="background: white; border-radius: 20px; padding: 32px; margin-bottom: 24px; box-shadow: 0 4px 20px rgba(0,0,0,0.08); border: 2px solid #e2e8f0; position: relative;">
            
            <!-- Delete Button (Hidden by default) -->
            <button 
                class="delete-btn" 
                onclick="deleteQuestion({{ $question->id }})" 
                style="display: none; position: absolute; top: 20px; right: 20px; background: #ef4444; color: white; border: none; padding: 10px 20px; border-radius: 10px; font-weight: 600; cursor: pointer; transition: all 0.3s; box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);"
            >
                🗑️ Delete
            </button>

            <!-- Question Number -->
            <div style="display: inline-block; background: linear-gradient(135deg, #3b82f6, #2563eb); color: white; padding: 8px 16px; border-radius: 10px; font-weight: 700; margin-bottom: 20px;">
                Question {{ $index + 1 }}
            </div>

            <!-- Question Text -->
            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 10px; font-size: 1.05rem;">Question:</label>
                <textarea 
                    class="question-text" 
                    readonly 
                    style="width: 100%; padding: 14px 18px; border: 2px solid #cbd5e1; border-radius: 12px; font-size: 1.05rem; min-height: 80px; resize: vertical; background: #f8fafc; transition: all 0.3s;"
                >{{ $question->question }}</textarea>
            </div>

            <!-- Options -->
            <div style="margin-bottom: 16px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 12px; font-size: 1.05rem;">Options:</label>
                
                @php
                    $options = is_array($question->options) ? $question->options : json_decode($question->options, true);
                @endphp
                @foreach($options as $optKey => $option)
                <div style="display: flex; align-items: center; gap: 12px; margin-bottom: 12px; padding: 12px; background: #f8fafc; border-radius: 10px; border: 1px solid #e2e8f0;">
                    <input 
                        type="radio" 
                        name="option_{{ $question->id }}" 
                        value="{{ $optKey }}"
                        disabled
                        style="width: 18px; height: 18px; cursor: pointer;"
                    >
                    <input 
                        type="text" 
                        class="option-text" 
                        data-key="{{ $optKey }}"
                        value="{{ is_string($option) ? $option : '' }}" 
                        readonly
                        style="flex: 1; padding: 10px 14px; border: 2px solid #cbd5e1; border-radius: 8px; font-size: 1rem; background: white; transition: all 0.3s;"
                    >
                </div>
                @endforeach
            </div>

            <!-- MBTI Type Indicator -->
            <div style="display: inline-block; background: #fef3c7; color: #92400e; padding: 8px 16px; border-radius: 8px; font-weight: 600; font-size: 0.95rem;">
                MBTI Dimension: {{ $index + 1 }}/4
            </div>
        </div>
        @endforeach
    </div>

    <!-- Empty State (if no questions) -->
    @if($questions->isEmpty())
    <div style="background: white; border-radius: 20px; padding: 60px 40px; text-align: center; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
        <div style="font-size: 4rem; margin-bottom: 20px;">📝</div>
        <h3 style="font-size: 1.6rem; color: #64748b; margin-bottom: 12px;">No Questions Yet</h3>
        <p style="color: #94a3b8; font-size: 1.05rem;">Click "Add Question" to create your first test question.</p>
    </div>
    @endif
</div>

<!-- Add Question Modal -->
<div id="addModal" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); z-index: 9999; align-items: center; justify-content: center;">
    <div style="background: white; border-radius: 24px; padding: 40px; max-width: 600px; width: 90%; box-shadow: 0 20px 60px rgba(0,0,0,0.3); position: relative; max-height: 90vh; overflow-y: auto;">
        <button 
            onclick="closeModal()" 
            style="position: absolute; top: 20px; right: 20px; background: none; border: none; font-size: 28px; cursor: pointer; color: #94a3b8; line-height: 1;"
        >
            ×
        </button>
        
        <h2 style="font-size: 1.8rem; font-weight: 700; color: #1e293b; margin-bottom: 24px;">➕ Add New Question</h2>
        
        <form id="addQuestionForm" method="POST" action="{{ route('admin.questions.store') }}">
            @csrf
            
            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px;">Question Text:</label>
                <textarea 
                    name="question" 
                    required 
                    style="width: 100%; padding: 12px 16px; border: 2px solid #cbd5e1; border-radius: 12px; font-size: 1rem; min-height: 100px; resize: vertical;"
                    placeholder="Enter your question here..."
                ></textarea>
            </div>

            <div style="margin-bottom: 20px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 12px;">Options:</label>
                
                <div style="margin-bottom: 12px;">
                    <input 
                        type="text" 
                        name="option_E" 
                        required 
                        placeholder="Option A (e.g., Extroverted response)"
                        style="width: 100%; padding: 12px 16px; border: 2px solid #cbd5e1; border-radius: 10px; font-size: 1rem;"
                    >
                    <small style="color: #64748b; font-size: 0.85rem; display: block; margin-top: 4px;">Value key: E (for MBTI dimension)</small>
                </div>

                <div style="margin-bottom: 12px;">
                    <input 
                        type="text" 
                        name="option_I" 
                        required 
                        placeholder="Option B (e.g., Introverted response)"
                        style="width: 100%; padding: 12px 16px; border: 2px solid #cbd5e1; border-radius: 10px; font-size: 1rem;"
                    >
                    <small style="color: #64748b; font-size: 0.85rem; display: block; margin-top: 4px;">Value key: I (for MBTI dimension)</small>
                </div>
            </div>

            <div style="margin-bottom: 24px;">
                <label style="display: block; font-weight: 600; color: #475569; margin-bottom: 8px;">Order:</label>
                <input 
                    type="number" 
                    name="order" 
                    min="1" 
                    value="{{ $questions->count() + 1 }}"
                    style="width: 100%; padding: 12px 16px; border: 2px solid #cbd5e1; border-radius: 10px; font-size: 1rem;"
                >
            </div>

            <div style="display: flex; gap: 12px;">
                <button 
                    type="button" 
                    onclick="closeModal()"
                    style="flex: 1; padding: 14px; background: #e2e8f0; color: #475569; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; font-size: 1.05rem;"
                >
                    Cancel
                </button>
                <button 
                    type="submit"
                    style="flex: 1; padding: 14px; background: linear-gradient(135deg, #10b981, #059669); color: white; border: none; border-radius: 12px; font-weight: 600; cursor: pointer; font-size: 1.05rem;"
                >
                    Add Question
                </button>
            </div>
        </form>
    </div>
</div>

<script>
let isEditMode = false;
let hasChanges = false;

function toggleEditMode() {
    isEditMode = !isEditMode;
    const editBtn = document.getElementById('editBtn');
    const saveBtn = document.getElementById('saveBtn');
    const textareas = document.querySelectorAll('.question-text, .option-text');
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    if (isEditMode) {
        editBtn.innerHTML = '<span>👁️</span> View Mode';
        editBtn.style.background = 'linear-gradient(135deg, #64748b, #475569)';
        textareas.forEach(ta => {
            ta.removeAttribute('readonly');
            ta.style.background = '#fff';
            ta.style.borderColor = '#3b82f6';
        });
        deleteButtons.forEach(btn => btn.style.display = 'block');
    } else {
        editBtn.innerHTML = '<span>✏️</span> Edit Questions';
        editBtn.style.background = 'linear-gradient(135deg, #3b82f6, #2563eb)';
        textareas.forEach(ta => {
            ta.setAttribute('readonly', true);
            ta.style.background = '#f8fafc';
            ta.style.borderColor = '#cbd5e1';
        });
        deleteButtons.forEach(btn => btn.style.display = 'none');
    }
}

// Track changes
document.addEventListener('input', function(e) {
    if (e.target.classList.contains('question-text') || e.target.classList.contains('option-text')) {
        hasChanges = true;
        const saveBtn = document.getElementById('saveBtn');
        saveBtn.disabled = false;
        saveBtn.style.background = 'linear-gradient(135deg, #10b981, #059669)';
        saveBtn.style.color = 'white';
        saveBtn.style.cursor = 'pointer';
    }
});

function saveChanges() {
    if (!hasChanges) return;
    
    const questions = [];
    document.querySelectorAll('.question-card').forEach(card => {
        const id = card.dataset.id;
        const questionText = card.querySelector('.question-text').value;
        const options = {};
        
        card.querySelectorAll('.option-text').forEach(opt => {
            const key = opt.dataset.key; // Get the actual key (E, I, S, N, T, F, J, P)
            options[key] = opt.value;
        });
        
        questions.push({ id, question: questionText, options });
    });
    
    // Send AJAX request
    fetch('{{ route("admin.questions.update") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ questions })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('✅ Changes saved successfully!');
            hasChanges = false;
            location.reload();
        }
    })
    .catch(error => {
        alert('❌ Error saving changes');
        console.error(error);
    });
}

function deleteQuestion(id) {
    if (!confirm('Are you sure you want to delete this question?')) return;
    
    fetch(`/admin/questions/${id}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('✅ Question deleted successfully!');
            location.reload();
        } else {
            alert('❌ Error: ' + (data.error || 'Unknown error'));
        }
    })
    .catch(error => {
        alert('❌ Error deleting question: ' + error.message);
        console.error(error);
    });
}

function addNewQuestion() {
    document.getElementById('addModal').style.display = 'flex';
}

function closeModal() {
    document.getElementById('addModal').style.display = 'none';
}

// Close modal on outside click
document.getElementById('addModal').addEventListener('click', function(e) {
    if (e.target === this) closeModal();
});
</script>

<style>
button:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(0,0,0,0.2) !important;
}

.question-card {
    transition: all 0.3s;
}

.question-card:hover {
    box-shadow: 0 8px 30px rgba(0,0,0,0.12) !important;
}
</style>
@endsection
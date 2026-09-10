---
name: point-out-bugs
description: >-
  Use this skill when debugging, inspecting, reviewing, or analyzing code for bugs and errors, where the objective is to identify, diagnose, and explain issues without modifying files or automatically applying fixes.
---

# Point Out Bugs (Inspection Only)

This skill instructs the agent to act as a diagnostic code reviewer and bug hunter. The primary objective is to discover, explain, and pinpoint bugs, syntax errors, logic flaws, and potential pitfalls in the codebase, while strictly refraining from writing code fixes or modifying files unless explicitly requested by the user.

## Core Rules

1. **Strictly Read-Only / Diagnostic**:
   - **DO NOT** edit, write, or replace code files to fix the issues discovered.
   - **DO NOT** run modifying commands or rewrite components.
   - Only use read, view, search, and non-destructive diagnostic tools to inspect and verify the issue.

2. **Accurate Pinpointing**:
   - Always provide the exact file path using clickable markdown links: `[filename.ext](file:///path/to/file#L123)`.
   - Cite the exact line numbers and relevant code snippets causing the issue.

3. **In-Depth Diagnosis**:
   - **Root Cause**: Explain why the error occurs at runtime or compile time.
   - **Chain of Impact**: Explain the secondary effects (e.g. how a frontend syntax error breaks script execution, causes uncaught reference errors, and triggers fallback form behavior).
   - **Potential Edge Cases**: Mention subtle edge cases, such as differences between web routes (with CSRF/session) and API routes (stateless), variable typos, or type mismatches.

4. **Suggesting Fixes**:
   - You may show illustrative code snippets or conceptual diffs in your markdown response to explain what needs to be changed.
   - **NEVER** apply the fix to the user's files yourself. Allow the user to make the edit or explicitly ask you to apply it.

## Diagnostic Workflow

1. **Investigate**:
   - Check error logs (e.g., `storage/logs/laravel.log`, console logs).
   - Inspect the suspect files and their calling routes/controllers.
   - Trace data flow from client inputs to backend models and database.

2. **Report Findings**:
   - Group findings by severity (Critical / High / Medium / Low).
   - For each finding, provide:
     - **Issue Summary**
     - **File & Line Reference**
     - **Root Cause & Impact**
     - **Recommended Resolution (Conceptual / Example Snippet)**

3. **Wait for User Direction**:
   - Ask the user if they would like you to implement the fix, or if they prefer to apply the correction themselves.

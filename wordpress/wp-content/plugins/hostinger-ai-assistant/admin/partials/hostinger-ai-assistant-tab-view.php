<?php

/**
 * Provide a admin area view for ai assistant
 *
 *
 * @link       https://hostinger.com
 * @since      1.0.0
 *
 * @package    Hostinger_Ai_Assistant
 * @subpackage Hostinger_Ai_Assistant/admin/partials
 */

$content = new Hostinger_Ai_Assistant_Content_Generation();
$post_types = $content->get_public_post_types();
$menu_icon = get_post_type_object($post_types[0])->menu_icon ?? 'dashicons-admin-post';

?>
<div class="hts-ai-assistant">
	<div class="wrapper">
        <div class="hts-ai-tab-head">
            <div class="hts-heading">
                <h2><?php echo __( 'AI Content Creator', 'hostinger-ai-assistant' ) ?></h2>
            </div>
            <div class="hts-ai-tutorials">
                <a href="https://www.hostinger.com/tutorials/how-to-use-hostinger-ai-plugin" class="hts-btn hts-secondary-btn" target="_blank">
                    <?php echo __( 'Open guide', 'hostinger-ai-assistant' ) ?>
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M2.5 5.2478C2.5 3.72902 3.73122 2.4978 5.25 2.4978H6C6.41421 2.4978 6.75 2.83359 6.75 3.2478C6.75 3.66202 6.41421 3.9978 6 3.9978H5.25C4.55964 3.9978 4 4.55745 4 5.2478V10.6859C4 11.3763 4.55964 11.9359 5.25 11.9359H10.7508C11.4411 11.9359 12.0008 11.3763 12.0008 10.6859V10C12.0008 9.58579 12.3366 9.25 12.7508 9.25C13.165 9.25 13.5008 9.58579 13.5008 10V10.6859C13.5008 12.2047 12.2696 13.4359 10.7508 13.4359H5.25C3.73122 13.4359 2.5 12.2047 2.5 10.6859V5.2478ZM12 5.06077L8.03033 9.03044C7.73744 9.32333 7.26256 9.32333 6.96967 9.03044C6.67678 8.73754 6.67678 8.26267 6.96967 7.96977L10.9393 4.00011L9 4.0001C8.58579 4.0001 8.25 3.66432 8.25 3.2501C8.25 2.83589 8.58579 2.5001 9 2.5001L12.25 2.50011C12.9404 2.50011 13.5 3.05975 13.5 3.75011V7.0001C13.5 7.41432 13.1642 7.7501 12.75 7.7501C12.3358 7.7501 12 7.41432 12 7.0001V5.06077Z" fill="#673DE6"/>
                    </svg>
                </a>
            </div>
        </div>
		<div class="hts-container">
			<div class="hts-description">
				<h3><?php echo __( 'What do you want to make today?', 'hostinger-ai-assistant' ) ?></h3>
			</div>
			<div class="hts-inputs-wrapper">
				<div class="hts-input-item">
					<div class="container">
						<div class="setting-description">
							<div class="setting-description-text">
								<span><?php echo __( 'Content Type', 'hostinger-ai-assistant' ) ?></span>
							</div>
						</div>
						<div class="wrapper-dropdown" id="dropdown">
							<?php if( isset( $post_types[0] ) ): ?>
								<span class="selected-display dashicons-before <?= $menu_icon ?>" id="hts-posttype" data-value="<?= $post_types[0] ?>"><?= get_post_type_object($post_types[0])->label ?></span>
							<?php endif; ?>
							<svg id="drp-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="hts-arrow transition-all ml-auto">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M7 10L12 15L17 10H7Z" fill="#727586"/>
							</svg>
							<ul class="dropdown">
								<?php
								$firstIteration = true;
								foreach ($post_types as $post_type) : ?>
									<li class="item dashicons-before <?php echo get_post_type_object($post_type)->menu_icon . ' '; if ($firstIteration) echo 'active'; ?>" data-value="<?= $post_type ?>"><?php echo get_post_type_object($post_type)->label; ?></li>
									<?php
									$firstIteration = false;
								endforeach;
								?>
							</ul>
						</div>
					</div>
					<div class="hts-input-description">
                        <p><?php echo __( 'Choose the type of content that will be generated', 'hostinger-ai-assistant' ) ?></p>
                    </div>
				</div>
				<div class="hts-input-item">
					<div class="container">
						<div class="setting-description">
							<div class="setting-description-text">
								<span><?php echo __( 'Tone of voice', 'hostinger-ai-assistant' ) ?></span>
							</div>
						</div>
						<div class="row hts-voice-wrapper">
							<select name="sel-01" id="hts-voice" class="select2-multiple-voice" multiple>
								<option value="neutral"><?= __( 'Neutral', 'hostinger-ai-assistant' )?></option>
								<option value="formal"><?= __( 'Formal', 'hostinger-ai-assistant' )?></option>
								<option value="trustworthy"><?= __( 'Trustworthy', 'hostinger-ai-assistant' )?></option>
								<option value="friendly"><?= __( 'Friendly', 'hostinger-ai-assistant' )?></option>
								<option value="witty"><?= __( 'Witty', 'hostinger-ai-assistant' )?></option>
							</select>
						</div>
					</div>
					<div class="hts-input-description">
						<p><?php echo __( 'Choose your desired emotional impact on readers', 'hostinger-ai-assistant' ) ?></p>
                    </div>
				</div>
				<div class="hts-input-item hts-content-length">
					<div class="container">
						<div class="setting-description">
							<div class="setting-description-text">
								<span><?php echo __( 'Content length', 'hostinger-ai-assistant' ) ?></span>
							</div>
						</div>
						<div class="wrapper-dropdown" id="dropdown">
								<span class="selected-display" id="hts-content-length" data-value="short"><?= __( 'Short', 'hostinger-ai-assistant' )?></span>
							<svg id="drp-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="hts-arrow transition-all ml-auto">
								<path fill-rule="evenodd" clip-rule="evenodd" d="M7 10L12 15L17 10H7Z" fill="#727586"/>
							</svg>
							<ul class="dropdown">
								<li class="item active" data-value="short">
									<span><?= __( 'Short', 'hostinger-ai-assistant' )?></span>
									<div class="hts-select-description">
										<p><?= __( 'Usually used for video, infographics, or product descriptions', 'hostinger-ai-assistant' )?></p>
									</div>
								</li>
								<li class="item" data-value="medium">
									<span><?= __( 'Medium', 'hostinger-ai-assistant' )?></span>
									<div class="hts-select-description">
										<p><?= __( 'Balances depth and readability, engaging audiences and driving leads.', 'hostinger-ai-assistant' )?></p>
									</div>
								</li>
								<li class="item" data-value="long">
									<span><?= __( 'Long', 'hostinger-ai-assistant' )?></span>
									<div class="hts-select-description">
										<p><?= __( 'Usually used to make high-ranked articles that will generate more leads', 'hostinger-ai-assistant' )?></p>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="hts-input-description">
                        <p><?php echo __( 'Choose the length of generated content', 'hostinger-ai-assistant' ) ?></p>
                    </div>
				</div>
			</div>
			<div class="hts-description">
				<h3><?php echo __( 'What is your content about?', 'hostinger-ai-assistant' ) ?></h3>
			</div>
			<div class="wrapper">
				<div class="hts-input-textarea">
					<div class="hts-label">
						<?php echo __( 'Content main idea', 'hostinger-ai-assistant' ) ?>
					</div>
					<textarea id="hts-ai-description-input"><?= __( 'Let us know more about your content idea. For example: Article about how to use WordPress to dive into website development including tutorials how to use it in a simple way...', 'hostinger-ai-assistant' ) ?></textarea>
				</div>
			</div>
			<div class="progress-bar-wrapper">
				<div class="progress-bar">
					<div class="progress-bar-step"></div>
					<div class="progress-bar-step"></div>
					<div class="progress-bar-step"></div>
				</div>
			</div>
			<div id="hts-input-message">
				<?php echo __('Enter at least 10 characters','hostinger-ai-assistant'); ?>
			</div>
			<div class="hts-focus-keywords">
				<div class="hts-description">
					<h3><?php echo __( 'What are the focus keywords of your content?', 'hostinger-ai-assistant' ) ?></h3> <span><?php echo __( 'Optional', 'hostinger-ai-assistant' ) ?></span>
				</div>
				<div class="hts-input-description">
					<?php echo __( 'If you skip this part, AI will automatically generate keyword suggestions after you generate the content', 'hostinger-ai-assistant' ) ?>
				</div>
				<select id="hts-focus-keywords" multiple></select>
				<div class="hts-input-description">
					<?php echo __( 'Press Enter key to finalize a keyword', 'hostinger-ai-assistant' ) ?>
				</div>
			</div>
			<a class="hts-submit-button hts-btn hts-primary-btn hts-disabled" rel="noopener noreferrer">
				<?php wp_nonce_field( 'generate_content', 'generate_content_nonce' ); ?>
				<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M19.3 8.12501L18.225 5.62501L15.625 4.47501L18.225 3.35001L19.3 0.975006L20.375 3.35001L22.975 4.47501L20.375 5.62501L19.3 8.12501ZM19.3 23L18.225 20.6L15.625 19.475L18.225 18.35L19.3 15.825L20.375 18.35L22.975 19.475L20.375 20.6L19.3 23ZM8.325 19.15L6.025 14.225L1 11.975L6.025 9.72501L8.325 4.82501L10.65 9.72501L15.65 11.975L10.65 14.225L8.325 19.15Z"
					      fill="#1D1E20"/>
				</svg>
				<?php echo __( 'Create content', 'hostinger-ai-assistant' ) ?>
			</a>
		</div>
		<div class="hts-ai-assistant-result">
			<div class="hts-loader-wrapper">
				<div class="hts-loader">
					<svg width="36" height="36" viewBox="0 0 36 36" fill="none" xmlns="http://www.w3.org/2000/svg">
						<path d="M28.95 12.1874L27.3375 8.4374L23.4375 6.7124L27.3375 5.0249L28.95 1.4624L30.5625 5.0249L34.4625 6.7124L30.5625 8.4374L28.95 12.1874ZM28.95 34.4999L27.3375 30.8999L23.4375 29.2124L27.3375 27.5249L28.95 23.7374L30.5625 27.5249L34.4625 29.2124L30.5625 30.8999L28.95 34.4999ZM12.4875 28.7249L9.0375 21.3374L1.5 17.9624L9.0375 14.5874L12.4875 7.2374L15.975 14.5874L23.475 17.9624L15.975 21.3374L12.4875 28.7249Z"
						      fill="#2F1C6A"/>
					</svg>
					<h3><?= __( 'Brewing content with magic', 'hostinger-ai-assistant' ) ?></h3>
				</div>
				<div class="hts-loader-container">
					<div id="hts-loader-progress-bar" class="hts-loader-progress"></div>
				</div>
			</div>
			<div id="hts-loader-response-container">

		      <div class="hts-response-content">
			      <?php require_once 'hostinger-ai-assistant-seo-meta-view.php'; ?>
			      <div class="hts-response-data"></div>
		      </div>

				<div class="hts-bottom-content">
					<div class="hts-words">
						<div id="hts-content-words"><span></span> <?= __( 'words', 'hostinger-ai-assistant' ) ?></div>
						<span class="hts-separator">|</span>
						<div id="hts-content-chars"><span></span> <?= __( 'characters', 'hostinger-ai-assistant' ) ?>
						</div>
					</div>
					<div class="hts-btn-wrapper">
					<div class="hts-btn hts-secondary-btn" id="hts-edit-as-draft">
						<?php wp_nonce_field( 'create_post', 'create_post_nonce' ); ?>
						<span class="button__text">
							<?= __( 'Edit as a draft', 'hostinger-ai-assistant' ) ?>
						</span>
					</div>
					<div class="hts-btn hts-primary-btn" id="hts-publish-post">
						<?php wp_nonce_field( 'publish_post', 'publish_post_nonce' ); ?>
						<span class="button__text">
							<?= __( 'Publish', 'hostinger-ai-assistant' ) ?>
						</span>
					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="hts-existing-content-popup">
			<h3>
				<?= __( 'Are you sure you want to replace your existing content with a new one ?', 'hostinger-ai-assistant' ) ?>
			</h3>
			<p>
				<?= __( 'Clicking <b>Generate new content</b> will permanently delete your existing content and generate a new one on your recent inputs.', 'hostinger-ai-assistant' ) ?>
			</p>
			<div class="hts-popup-buttons">
				<div class="hts-cancel">
					<?=__( 'Cancel', 'hostinger-ai-assistant' )?>
				</div>
				<div class="hts-btn hts-primary-btn hts-confirm-btn">
					<?=__( 'Generate new content', 'hostinger-ai-assistant' )?>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="hts-loader-modal">
    <div class="hts-loader-modal__content">
        <div class="hts-loader-modal__image-wrap">
            <img src="<?php echo HOSTINGER_AI_ASSISTANT_PLUGIN_URL . 'assets/img/loading-modal-icon.svg'; ?>" alt="<?php echo esc_attr( __( 'Generating content...', 'hostinger-ai-assistant' ) ); ?>">
        </div>
        <div class="hts-loader-modal__title">
            <?php echo __( 'Generating content...', 'hostinger-ai-assistant' ) ?>
        </div>
        <div class="hts-loader-modal__description">
            <?php echo __( 'This will only take a moment', 'hostinger-ai-assistant' ) ?>
        </div>
        <div class="hts-loader-modal__loader-wrap">
            <div class="hts-loader-modal__loader"></div>
        </div>
    </div>
</div>

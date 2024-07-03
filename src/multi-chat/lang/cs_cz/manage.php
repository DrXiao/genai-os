<?php

return [
    'route' => 'Správa',
    'interface.header' => 'Správa rozhraní administrátora',
    'button.delete' => 'Smazat',
    'button.update' => 'Aktualizovat',
    'button.create' => 'Vytvořit',
    'button.save' => 'Uložit',
    'button.yes' => 'Ano, souhlasím',
    'button.no' => 'Ne, zrušit',
    'button.cancel' => 'Zrušit',
    'button.close' => 'Zavřít',
    'button.accept' => 'Souhlasím',

    //Tabs
    'tab.groups' => 'Skupiny',
    'tab.users' => 'Uživatelé',
    'tab.llms' => 'Modely',
    'tab.settings' => 'Nastavení',

    //Groups
    'button.new_group' => 'Nová skupina',
    'header.create_group' => 'Vytvořit novou skupinu',
    'label.tab_permissions' => 'Oprávnění stránky',
    'label.invite_code' => 'Pozvánkový kód',
    'label.group_name' => 'Název',
    'placeholder.invite_code' => 'Pozvánkový kód',
    'label.describe' => 'Popis',
    'placeholder.group_name' => 'Název skupiny',
    'placeholder.group_detail' => 'Detail skupiny',
    'label.read' => 'Číst',
    'label.delete' => 'Smazat',
    'label.update' => 'Aktualizovat',
    'label.create' => 'Vytvořit',
    'label.llm_permission.disabled' => 'Oprávnění k modelu (model je vypnut)',
    'label.llm_permission.enabled' => 'Oprávnění k modelu (model je zapnut)',
    'header.edit_group' => 'Upravit skupinu',
    'hint.group_updated' => 'Skupina byla úspěšně aktualizována!',
    'hint.group_created' => 'Skupina byla úspěšně vytvořena!',
    'modal.delete_group.header' => 'Opravdu chcete smazat tuto skupinu?',

    // Users
    'header.menu' => 'Hlavní menu',
    'header.group_selector' => 'Výběr skupiny',
    'header.fuzzy_search' => 'Fuzzy vyhledávání',
    'header.create_user' => 'Vytvořit uživatele',
    'label.group_selector' => 'Filtrovat uživatele ze skupiny',
    'label.fuzzy_search' => 'Vyhledat uživatele podle jména nebo emailu',
    'label.create_user' => 'Vytvořit uživatelský profil',

    'create_user.header' => 'Vytvořit nový účet',
    'create_user.joined_group' => 'Připojené skupiny',
    'label.members' => 'Členové',
    'label.other_users' => 'Ostatní uživatelé',
    'button.return_group_list' => 'Zpět na seznam skupin',
    'placeholder.search_user' => 'Vyhledat podle emailu nebo jména',
    'hint.enter_to_search' => 'Stiskněte Enter pro vyhledání',

    'group_selector.header' => 'Editovat uživatele',
    'placeholder.email' => 'Email uživatele',
    'placeholder.username' => 'Uživatelské jméno',
    'label.name' => 'Jméno',
    'modal.delete_user.header' => 'Opravdu chcete smazat uživatele?',
    'button.cancel' => 'Zrušit',
    'label.email' => 'Email',
    'label.password' => 'Heslo',
    'label.update_password' => 'Aktualizovat heslo',
    'label.detail' => 'Detaily',
    'placeholder.new_password' => 'Nové heslo',
    'label.require_change_password' => 'Vyžadovat změnu hesla při příštím přihlášení',
    'label.extra_setting' => 'Další nastavení',
    'label.created_at' => 'Vytvořeno',
    'label.updated_at' => 'Aktualizováno',

    //LLMs
    'button.new_model' => 'Nový model',
    'label.enabled_models' => 'Povolené modely',
    'label.disabled_models' => 'Zakázané modely',
    'header.create_model' => 'Vytvořit nastavení modelu',
    'modal.create_model.header' => 'Opravdu chcete vytvořit tento soubor s nastavením?',
    'label.model_image' => 'Obrázek modelu',
    'label.model_name' => 'Název modelu',
    'label.order' => 'Pořadí',
    'label.link' => 'Odkaz',
    'placeholder.description' => 'Popis tohoto modelu',
    'label.version' => 'Verze',
    'label.access_code' => 'Přístupový kód',
    'placeholder.link' => 'Externí odkaz na tento model',
    'header.update_model' => 'Upravit nastavení modelu',
    'label.description' => 'Popis',
    'modal.update_model.header' => 'Opravdu chcete aktualizovat tento soubor s nastavením jazykového modelu?',
    'modal.delete_model.header' => 'Opravdu chcete tento soubor s nastavením jazykového modelu smazat?',

    //setting
    'header.settings' => 'Nastavení systému',
    'label.settings' => 'Všechna nastavení týkající se systému lze zde upravit',
    'label.agent_API' => 'Agent API adresa',
    'label.allow_register' => 'Povolit registraci',
    'button.reset_redis' => 'Obnovit Redis cache',
    'hint.saved' => 'Uloženo',
    'hint.redis_cache_cleared' => 'Redis cache byla vyčištěna',
    'label.need_invite' => 'Registrace vyžaduje pozvánku',
    'label.footer_warning' => 'Varování v patičce',
    'label.safety_guard_API' => 'Adresa bezpečnostní brány',
    'label.anno' => 'Oznámení systému',
    'label.tos' => 'Podmínky služby',
    'label.upload_max_size_mb' => 'Maximální velikost nahrávaného souboru (MB)',
    'label.upload_allowed_extensions' => 'Povolené přípony souborů',

    //Permissions
    'perm.Room_update_import_chat' => 'Importovat konverzaci',
    'perm.Room_update_new_chat' => 'Vytvořit novou konverzaci',
    'perm.Room_update_feedback' => 'Poskytnout zpětnou vazbu',
    'perm.Room_update_send_message' => 'Odeslat zprávu',
    'perm.Room_update_react_message' => 'Reagovat na zprávu',
    'perm.Room_read_export_chat' => 'Exportovat konverzaci',
    'perm.Room_delete_chatroom' => 'Smazat konverzaci',
    'perm.Chat_update_react_message' => 'Reagovat na zprávu',
    'perm.Dashboard_read_statistics' => 'Číst statistiky',
    'perm.Dashboard_read_blacklist' => 'Číst blacklist',
    'perm.Dashboard_read_feedbacks' => 'Číst zpětnou vazbu',
    'perm.Dashboard_read_logs' => 'Číst logy',
    'perm.Dashboard_read_safetyguard' => 'Číst ochranný systém',
    'perm.Dashboard_read_inspect' => 'Číst prohlížeč zpráv',
    'perm.Chat_update_detail_feedback' => 'Detailní zpětná vazba',
    'perm.Room_update_detail_feedback' => 'Detailní zpětná vazba',
    'perm.Chat_update_send_message' => 'Odeslat zprávu',
    'perm.Chat_update_new_chat' => 'Vytvořit novou konverzaci',
    'perm.Chat_update_upload_file' => 'Nahrát soubor',
    'perm.Chat_update_feedback' => 'Poskytnout zpětnou vazbu',
    'perm.Chat_update_import_chat' => 'Importovat konverzaci',
    'perm.Room_read_access_to_api' => 'Přístup k API webu',
    'perm.Chat_read_export_chat' => 'Exportovat konverzaci',
    'perm.Chat_delete_chatroom' => 'Smazat konverzaci',
    'perm.Profile_update_api_token' => 'Aktualizovat klíč API webu',
    'perm.Profile_update_name' => 'Změnit uživatelské jméno',
    'perm.Profile_update_email' => 'Změnit e-mailovou adresu',
    'perm.Profile_update_password' => 'Změnit heslo',
    'perm.Profile_update_external_api_token' => 'Upravit externí API klíč',
    'perm.Profile_read_api_token' => 'Přečíst API klíč webu',
    'perm.Profile_delete_account' => 'Smazat účet',
    'perm.Store_create_community_bot' => 'Komunitní bot',
    'perm.Store_create_private_bot' => 'Soukromý bot',
    'perm.Store_create_group_bot' => 'Skupinový bot',
    'perm.Store_update_modify_bot' => 'Upravit bota',
    'perm.Store_delete_delete_bot' => 'Smazat bota',
    'perm.Store_read_discover_community_bots' => 'Přístup k botům komunity',
    'perm.Store_read_discover_system_bots' => 'Přístup k systémovým botům',
    'perm.Store_read_discover_private_bots' => 'Přístup k vlastním botům',
    'perm.Store_read_discover_group_bots' => 'Přístup ke skupinovým botům',
    'perm.Store_read_any_modelfile' => 'Přístup k jakémukoli souboru modelu',

    'perm.Chat_update_detail_feedback.describe' => 'Poskytnout podrobnější zpětnou vazbu na odpovědi',
    'perm.Room_update_detail_feedback.describe' => 'Poskytnout podrobnější zpětnou vazbu na odpovědi',
    'perm.Profile_update_name.describe' => 'Aktualizovat vlastní jméno účtu',
    'perm.Profile_update_email.describe' => 'Aktualizovat vlastní e-mailovou adresu',
    'perm.Profile_update_password.describe' => 'Aktualizovat vlastní heslo',
    'perm.Profile_update_external_api_token.describe' => 'Aktualizovat oprávnění pro uložení externího API klíče na webu',
    'perm.Profile_read_api_token.describe' => 'Popis práva číst API token webu',
    'perm.Profile_delete_account.describe' => 'Popis práva smazat účet',
    'perm.Profile_update_api_token.describe' => 'Popis práva aktualizovat API token webu',
    'perm.Room_read_access_to_api.describe' => 'Popis práva přístupu k API webu',
    'perm.Chat_update_send_message.describe' => 'Popis práva odeslat zprávu v konverzaci (neovlivňuje vytváření)',
    'perm.Room_update_send_message.describe' => 'Popis práva odeslat zprávu v místnosti (neovlivňuje vytváření)',
    'perm.Chat_update_new_chat.describe' => 'Popis práva vytvořit konverzaci',
    'perm.Room_update_new_chat.describe' => 'Popis práva vytvořit místnost',
    'perm.Chat_update_upload_file.describe' => 'Popis práva nahrát soubor (vyžaduje právo vytvořit konverzaci)',
    'perm.Chat_update_feedback.describe' => 'Popis práva odeslat zpětnou vazbu k použití modelu',
    'perm.Room_update_feedback.describe' => 'Popis práva odeslat zpětnou vazbu k použití modelu',
    'perm.Room_delete_chatroom.describe' => 'Popis práva smazat místnost',
    'perm.Chat_delete_chatroom.describe' => 'Popis práva smazat konverzaci',
    'perm.Chat_read_export_chat.describe' => 'Popis práva exportovat chatovou historii',
    'perm.Room_read_export_chat.describe' => 'Popis práva exportovat chatovou historii místnosti',
    'perm.Chat_update_import_chat.describe' => 'Popis práva importovat chatovou historii (vyžaduje právo vytvořit konverzaci)',
    'perm.Room_update_import_chat.describe' => 'Popis práva importovat chatovou historii místnosti (vyžaduje právo vytvořit místnost)',
    'perm.Chat_update_react_message.describe' => 'Popis práva reagovat na zprávy pomocí dalších tlačítek (např. citace, překlad)',
    'perm.Room_update_react_message.describe' => 'Popis práva reagovat na zprávy v místnostech pomocí dalších tlačítek (např. citace, překlad)',
    'perm.Dashboard_read_statistics.describe' => 'Popis práva číst statistiky',
    'perm.Dashboard_read_blacklist.describe' => 'Popis práva číst černou listinu',
    'perm.Dashboard_read_feedbacks.describe' => 'Popis práva číst zpětnou vazbu',
    'perm.Dashboard_read_logs.describe' => 'Popis práva číst systémové záznamy',
    'perm.Dashboard_read_safetyguard.describe' => 'Popis práva číst bezpečnostní ochranu',
    'perm.Dashboard_read_inspect.describe' => 'Popis práva číst prohlížeč zpráv',
    'perm.Store_create_community_bot.describe' => 'Oprávnění potřebné k vytvoření komunitního bota',
    'perm.Store_create_private_bot.describe' => 'Oprávnění potřebné k vytvoření soukromého bota',
    'perm.Store_create_group_bot.describe' => 'Oprávnění potřebné k vytvoření skupinového bota',
    'perm.Store_update_modify_bot.describe' => 'Oprávnění potřebné k úpravě vlastních botů',
    'perm.Store_delete_delete_bot.describe' => 'Oprávnění potřebné ke smazání vlastních botů',
    'perm.Store_read_discover_community_bots.describe' => 'Oprávnění potřebné k zobrazení botů komunity',
    'perm.Store_read_discover_system_bots.describe' => 'Oprávnění potřebné k zobrazení systémových botů',
    'perm.Store_read_discover_private_bots.describe' => 'Oprávnění potřebné ke čtení vlastních botů',
    'perm.Store_read_discover_group_bots.describe' => 'Oprávnění potřebné ke čtení skupinových botů',
    'perm.Store_read_any_modelfile.describe' => 'Oprávnění potřebné k přístupu k jakémukoli souboru modelu',
];
